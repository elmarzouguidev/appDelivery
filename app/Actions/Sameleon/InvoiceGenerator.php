<?php

namespace App\Actions\Sameleon;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Invoice;
use App\Models\Sameleon\User;
use App\Status\Status;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class InvoiceGenerator
{
    use AsAction;

    protected $invoice;

    protected $client;

    public function handle()
    {

        if (
            !now()->isWeekend() && Command::whereDay('created_at', now()->format('d'))
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->whereNotNull('delivered_at')
            ->doesntHave('articles')
            //->whereDay('delivered_at', now()->format('d'))
            ->count() > 0
        ) {

            $commands =  Command::whereDay('created_at', now()->format('d'))
                ->whereIn('status', [Status::LIVRE, Status::REFUSE])
                ->whereNotNull('delivered_at')
                ->doesntHave('articles')
                //->whereDay('delivered_at', now()->format('d'))
                ->latest()->get();
           // $commands->dd();
            $this->client = User::find($commands->user_id);

            $this->invoice = Invoice::whereDay('created_at', now()->format('d'))
                ->where('user_id', $commands->user_id)
                ->where('user_uuid', $this->client->uuid)
                ->first();

            if ($this->invoice) {
                //$this->deleteCommands();
                $this->addItems();
                $this->addOldItems();
                $this->checkArticles();
            } else {

                $this->invoice = new Invoice();
                $this->invoice->invoice_date = now()->format('Y-m-d');
                $this->invoice->client()->associate($commands->user_id);
                $this->invoice->user_uuid = $this->client->uuid;
                $this->invoice->save();
            }
        }
    }

    private function addItems()
    {
        $commands = $this->client
            ->commands()
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->doesntHave('articles')
            ->whereDay('created_at', now()->format('d'))
            ->whereNotNull('delivered_at')
            //->whereDay('delivered_at', now()->format('d'))
            ->withSum('products', 'product_command.price_total')
            ->latest()->get();

        if ($commands) {

            $newCommands =  $commands->map(function ($item, $key) {

                $item->update(['invoice_id' => $this->invoice->id, 'invoice_uuid' => $this->invoice->uuid]);
                $price = $item->status == Status::REFUSE ? 0 : $item->products_sum_product_commandprice_total;
                return [
                    'command_id' => $item->id,
                    'command_uuid' => $item->uuid,
                    'code_command' => $item->code,
                    'date_command' => $item->created_at->format('d-m-Y'),
                    'city' => $item->city->name,
                    'status' => __('status.statuses.' . $item->status),
                    'price_total' => $price ?? 0,
                    'frais' => $item->frais,
                ];
            })->toArray();

            // dd($newCommands, $commands);
            //return redirect()->route('public.show.invoice', [$this->invoice->uuid, 'has_header' => true]);

            $this->invoice->articles()->createMany($newCommands);
        }
    }

    private function checkArticles()
    {
        
        $commandsLivred =  $this->client
            ->commands()
            ->where('status', Status::LIVRE)
            ->whereDay('created_at', now()->format('d'))
            //->orWhereDay('created_at', Carbon::yesterday()->format('d'))
            ->whereNotNull('delivered_at')
            ->whereHas('articles', function ($query) {
                $query->where('price_total', '<=', 0);
            })

            //->whereDay('delivered_at', now()->format('d'))
            ->withSum('products', 'product_command.price_total')
            ->get();
        $commandsRefused =  $this->client
            ->commands()
            ->where('status', Status::REFUSE)
            //->whereDay('created_at', now()->format('d'))
            //->orWhereDay('created_at', Carbon::yesterday()->format('d'))
            ->whereNotNull('delivered_at')
            ->whereHas('articles', function ($query) {
                $query->where('price_total', '>', 0);
            })

            //->whereDay('delivered_at', now()->format(s'd'))
            //->withSum('products', 'product_command.price_total')
            ->get();

        if ($commandsLivred) {
            // dd('wwwD',$commands);
            $commandsLivred->map(function ($item, $key) {
                $price = $item->products_sum_product_commandprice_total;
                $item->articles()->update(['price_total' => $price]);
            });
        }
        if ($commandsRefused) {
            // dd('wwwD',$commands);
            $commandsRefused->map(function ($item, $key) {
                ///$price = $item->products_sum_product_commandprice_total;
                $item->articles()->update(['price_total' => 0]);
            });
        }
    }

    private function addOldItems()
    {
  
        $commands = $this->client

            ->commands()
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->doesntHave('articles')
            ->whereDay('created_at', Carbon::yesterday()->format('d'))
            ->whereNotNull('delivered_at')
            //->whereDay('delivered_at',now()->format('d'))
            ->withSum('products', 'product_command.price_total')
            ->latest()->get();

        if ($commands) {

            $newCommands =  $commands->map(function ($item, $key) {

                $item->update(['invoice_id' => $this->invoice->id, 'invoice_uuid' => $this->invoice->uuid]);

                $price = $item->status == Status::REFUSE ? 0 : $item->products_sum_product_commandprice_total;

                return [
                    'command_id' => $item->id,
                    'command_uuid' => $item->uuid,
                    'code_command' => $item->code,
                    'date_command' => $item->created_at->format('d-m-Y'),
                    'city' => $item->city->name,
                    'status' => __('status.statuses.' . $item->status),
                    'price_total' => $price ?? 0,
                    'frais' => $item->frais,
                ];
            })->toArray();

            //dd($newCommands, $commands);
            //return redirect()->route('public.show.invoice', [$this->invoice->uuid, 'has_header' => true]);

            $this->invoice->articles()->createMany($newCommands);
        }
    }

    private function deleteCommands()
    {

        $commands = $this->client
            ->commands()
            ->whereNotIn('status', [Status::LIVRE, Status::REFUSE])
            ->has('articles')
            ->where('delivered_at', '00:00:00')
            ->whereDay('created_at', now()->format('d'))
            //->orWhereDay('created_at', Carbon::yesterday()->format('d'))

            //->whereDay('delivered_at', now()->format('d'))
            //->withSum('products', 'product_command.price_total')
            ->latest()->get();

        if ($commands) {

            $commands->map(function ($item, $key) {
                $item->articles()->delete();
                $item->update(['invoice_id' => null, 'invoice_uuid' => null]);
            });

            //dd($commands);
        }
    }
}
