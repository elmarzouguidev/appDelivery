<?php

namespace App\Actions\Sameleon;

use App\Models\Sameleon\Client;
use App\Models\Sameleon\Invoice;
use App\Status\Status;
use Lorisleiva\Actions\Concerns\AsAction;

class GeneratDayInvoiceAction
{
    use AsAction;
    protected $invoice;

    public function handle()
    {
        
        if (
            !now()->isWeekend() && auth()->user()->hasRole('Client') && auth()->user()->commands()
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->whereDay('created_at', now()->format('d'))
            ->whereNotNull('delivered_at')
            //->whereDay('delivered_at', now()->format('d'))
            ->count() > 0
        ) {

            $this->invoice = Invoice::whereDay('created_at', now()->format('d'))
                ->where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->first();

            if ($this->invoice) {
                $this->addItems();
            } else {

                $this->invoice = new Invoice();
                $this->invoice->invoice_date = now()->format('Y-m-d');
                $this->invoice->client()->associate(auth()->id());
                $this->invoice->user_uuid = auth()->user()->uuid;
                $this->invoice->save();
            }
        }
    }

    private function addItems()
    {

        $commands = auth()
            ->user()
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

                return [
                    'command_id' => $item->id,
                    'command_uuid' => $item->uuid,
                    'code_command' => $item->code,
                    'date_command' => $item->created_at->format('d-m-Y'),
                    'city' => $item->city->name,
                    'status' => __('status.statuses.' . $item->status),
                    'price_total' => $item->products_sum_product_commandprice_total ?? 0,
                    'frais' => $item->frais,
                ];
            })->toArray();

            // dd($newCommands, $commands);
            //return redirect()->route('public.show.invoice', [$this->invoice->uuid, 'has_header' => true]);

            $this->invoice->articles()->createMany($newCommands);
        }
    }
}
