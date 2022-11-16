<?php

namespace App\Actions\Sameleon;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Invoice;
use App\Models\Sameleon\User;
use App\Status\InvoiceStatus;
use App\Status\Status;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class InvoiceGenerator
{
    use AsAction;

    protected $invoice;

    public function handle()
    {
        
        $this->CloseYesterdayInvoice();

        $this->deleteCommands();

        $this->updateRefusedCommand();

       // $this->deleteNullInvoices();
        //!now()->isWeekend();
        // dd(now()->format('H:i') =='17:16');
        $commands = Command::whereIn('status', [Status::LIVRE, Status::REFUSE])

            ->where(function ($q) {
                $q->whereDate('delivered_at', now()->format('Y-m-d'))
                    ->orWhereYear('delivered_at', '1993');
            })
            ->where('is_closed', false)
            //->doesntHave('articles')
            //->with('client:id,uuid')
            ->get();

            //dd($commands,"fg");
        if ($commands && $commands->count() > 0) {

            $users =  $commands->map(function ($command, $key) {

                return ['user_id' => $command->user_id, 'user_uuid' => $command->user_uuid];
            });

            // dd($users,"##");
            foreach ($users as $user) {
                // dd($user);

                $this->invoice = Invoice::whereDate('created_at', now()->format('Y-m-d'))
                   //whereDate('delivered_at', now()->format('Y-m-d'))
                    ->where('user_id', $user['user_id'])
                    ->where('user_uuid', $user['user_uuid'])
                    ->first();

                if ($this->invoice) {

                    //dd('YESH here');
                    $this->addItems($user['user_id']);
                    $this->addOldItems($user['user_id']);
                    $this->checkArticles($user['user_id']);
                } else {

                    $this->invoice = new Invoice();
                    $this->invoice->invoice_date = now()->format('Y-m-d');
                    $this->invoice->client()->associate($user['user_id']);
                    $this->invoice->user_uuid = $user['user_uuid'];
                    $this->invoice->status = InvoiceStatus::ENCOURS;
                    $this->invoice->save();
                }
            }
        }
    }

    private function addItems($userId)
    {
        
        $user = User::find($userId);
        $commands = $user
            ->commands()
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->doesntHave('articles')
            ->where(function ($q) {
                $q->whereDate('delivered_at', now()->format('Y-m-d'))
                    ->orWhereYear('delivered_at', '1993');
            })
            ->withSum('items', 'prix_total')
            ->get();
            //dd('addItmes',$commands);
        if ($commands) {

        
            $newCommands =  $commands->map(function ($item, $key) {

                $item->update(['invoice_id' => $this->invoice->id, 'invoice_uuid' => $this->invoice->uuid]);

                $price = $item->status == Status::REFUSE ? 0 : $item->items_sum_prix_total;

                return [
                    'command_id' => $item->id,
                    'command_uuid' => $item->uuid,
                    'code_command' => $item->code,
                    'date_command' => $item->created_at->format('d-m-Y'),
                    'city' => $item->city->name ?? $item->client_city,
                    'status' => __('status.statuses.' . $item->status),
                    'price_total' => $price ?? 0,
                    'frais' => $item->frais,
                    'profit'=>$item->city->profit ?? 0,
                    'is_delivery'=>false
                ];
            })->toArray();

           $this->invoice->articles()->createMany($newCommands);
           

        }
    }

    private function checkArticles($userId)
    {
        $user = User::find($userId);
        $commandsLivred = $user
            ->commands()
            ->where('status', Status::LIVRE)
            ->whereDate('delivered_at', now()->format('Y-m-d'))
            ->whereNotNull('delivered_at')
            ->whereHas('articles', function ($query) {
                $query->where('price_total', '<=', 0);
            })
            ->withSum('items', 'prix_total')
            ->get();
        $commandsRefused = $user
            ->commands()
            ->where('status', Status::REFUSE)
            ->whereYear('delivered_at', '1993')
            ->whereNotNull('delivered_at')
            ->whereHas('articles', function ($query) {
                $query->where('price_total', '>', 0);
            })
            ->get();

        if ($commandsLivred) {
            $commandsLivred->map(function ($item, $key) {
                $price = $item->items_sum_prix_total;
                $item->articles()->update(['price_total' => $price]);
            });
        }
        if ($commandsRefused) {
            $commandsRefused->map(function ($item, $key) {
                $item->articles()->update(['price_total' => 0]);
            });
        }
    }

    private function addOldItems($userId)
    {
        $user = User::find($userId);
        $commands = $user
            ->commands()
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->doesntHave('articles')
            //->whereDay('created_at', Carbon::yesterday()->format('d'))
            ->whereDate('created_at', '!=', now()->format('Y-m-d'))
            ->where(function ($q) {
                $q->whereDate('delivered_at', now()->format('Y-m-d'))
                    ->orWhereYear('delivered_at', '1993');
            })
            ->whereNotNull('delivered_at')
            ->withSum('items', 'prix_total')
            ->get();

        if ($commands) {

            $newCommands =  $commands->map(function ($item, $key) {

                $item->update(['invoice_id' => $this->invoice->id, 'invoice_uuid' => $this->invoice->uuid]);

                $price = $item->status == Status::REFUSE ? 0 : $item->items_sum_prix_total;

                return [
                    'command_id' => $item->id,
                    'command_uuid' => $item->uuid,
                    'code_command' => $item->code,
                    'date_command' => $item->created_at->format('d-m-Y'),
                    'city' => $item->city->name ?? $item->client_city,
                    'status' => __('status.statuses.' . $item->status),
                    'price_total' => $price ?? 0,
                    'frais' => $item->frais,
                    'profit'=>$item->city->profit ?? 0,
                ];
            })->toArray();

            $this->invoice->articles()->createMany($newCommands);
        }
    }

    private function deleteCommands()
    {

        $commands = Command::whereNotIn('status', [Status::LIVRE, Status::REFUSE])
            ->has('articles')
            ->get();

        if ($commands) {

            $commands->map(function ($item, $key) {

                $item->articles()->delete();
                $item->update(['invoice_id' => null, 'invoice_uuid' => null]);
            });

            //dd($commands);
        }
    }

    private function updateRefusedCommand()
    {
        $commands = Command::whereIn('status', [Status::REFUSE])
            ->has('articles')
            ->get();

        if ($commands) {

            $commands->map(function ($item, $key) {
                $item->articles()->update(['price_total' => 0]);
            });
        }
    }

    private function CloseYesterdayInvoice()
    {
        $invoices = Invoice::whereDate('created_at', '!=', now()->format('Y-m-d'))
            //->whereDay('created_at', Carbon::yesterday()->format('d'))
            ->where('cloture', false)
            ->select(['id', 'cloture'])->get();
        $invoices->each->update(['cloture' => true]);
        $invoices->each(function ($invoice) {
            $invoice->commands()->update(['is_closed' => true]);
        });

        $this->clearAllCachedArchive();
    }

    private function deleteNullInvoices()
    {
        $invoices = Invoice::doesntHave('articles')->get();

        if ($invoices) {
            foreach ($invoices as $invoice) {
                $invoice->delete();
            }
        }
    }

    private function clearAllCachedArchive()
    {
        cache()->pull('all_commands_archived_cache');
    }
}
