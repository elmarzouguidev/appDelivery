<?php

namespace App\Actions\Sameleon;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\DeliveryInvoice;
use App\Models\Sameleon\Invoice;
use App\Models\Sameleon\User;
use App\Status\InvoiceStatus;
use App\Status\Status;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class InvoiceDeliveryGenerator
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
            ->whereDeliveryId(delivery()->id)
            ->whereDeliveryUuid(delivery()->uuid)
            ->where(function ($q) {
                $q->whereDate('delivered_at', now()->format('Y-m-d'))
                    ->orWhereYear('delivered_at', '1993');
            })
            ->where('is_closed', false)
            //->doesntHave('deliveryArticles')
            //->with('client:id,uuid')
            ->get();

            //dd($commands);

        if ($commands && $commands->count() > 0) {

            $deliveries =  $commands->map(function ($command, $key) {

                return ['delivery_id' => $command->delivery_id, 'delivery_uuid' => $command->delivery_uuid];
            });

            //dd($deliveries,"##");
            foreach ($deliveries as $delivery) {
                //dd($delivery);

                $this->invoice = DeliveryInvoice::whereDate('created_at', now()->format('Y-m-d'))
                   //whereDate('delivered_at', now()->format('Y-m-d'))
                    ->where('delivery_id', $delivery['delivery_id'])
                    ->where('delivery_uuid', $delivery['delivery_uuid'])
                    ->first();

                if ($this->invoice) {

                    //dd('ues');
                    $this->addItems($delivery['delivery_id']);
                    $this->addOldItems($delivery['delivery_id']);
                    $this->checkArticles($delivery['delivery_id']);

                } else {

                    $this->invoice = new DeliveryInvoice();
                    $this->invoice->invoice_date = now()->format('Y-m-d');
                    $this->invoice->delivery()->associate($delivery['delivery_id']);
                    $this->invoice->delivery_uuid = $delivery['delivery_uuid'];

                    $this->invoice->city()->associate($this->invoice->delivery->city->id);
                    $this->invoice->city_uuid = $this->invoice->delivery->city->uuid;

                    $this->invoice->status = InvoiceStatus::ENCOURS;

                    $this->invoice->save();
                }
            }
        }
    }

    private function addItems($userId)
    {
        $user = Delivery::find($userId);
        $commands = $user
            ->commands()
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->doesntHave('deliveryArticles')
            ->where(function ($q) {
                $q->whereDate('delivered_at', now()->format('Y-m-d'))
                    ->orWhereYear('delivered_at', '1993');
            })
            ->withSum('items', 'prix_total')
            ->get();

            //dd($commands,"kgkg");

        if ($commands) {

            $newCommands =  $commands->map(function ($item, $key) {

                $item->update(['delivery_invoice_id' => $this->invoice->id, 'delivery_invoice_uuid' => $this->invoice->uuid]);

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
                    'profit'=> $item->city->profit ?? 0,
                    'is_delivery'=>true
                ];
            })->toArray();

            $this->invoice->articles()->createMany($newCommands);
        }
    }

    private function checkArticles($userId)
    {
        $user = Delivery::find($userId);
        $commandsLivred = $user
            ->commands()
            ->where('status', Status::LIVRE)
            ->whereDate('delivered_at', now()->format('Y-m-d'))
            ->whereNotNull('delivered_at')
            ->whereHas('deliveryArticles', function ($query) {
                $query->where('price_total', '<=', 0);
            })
            ->withSum('items', 'prix_total')
            ->get();
        $commandsRefused = $user
            ->commands()
            ->where('status', Status::REFUSE)
            ->whereYear('delivered_at', '1993')
            ->whereNotNull('delivered_at')
            ->whereHas('deliveryArticles', function ($query) {
                $query->where('price_total', '>', 0);
            })
            ->get();

        if ($commandsLivred) {
            $commandsLivred->map(function ($item, $key) {
                $price = $item->items_sum_prix_total;
                $item->deliveryArticles()->update(['price_total' => $price]);
            });
        }
        if ($commandsRefused) {
            $commandsRefused->map(function ($item, $key) {
                $item->deliveryArticles()->update(['price_total' => 0]);
            });
        }
    }

    private function addOldItems($userId)
    {
        $user = Delivery::find($userId);
        $commands = $user
            ->commands()
            ->whereIn('status', [Status::LIVRE, Status::REFUSE])
            ->doesntHave('deliveryArticles')
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

                $item->update(['delivery_invoice_id' => $this->invoice->id, 'delivery_invoice_uuid' => $this->invoice->uuid]);

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
                    'profit'=> $item->city->profit ?? 0,
                    'is_delivery'=>true
                ];
            })->toArray();

            $this->invoice->articles()->createMany($newCommands);
        }
    }

    private function deleteCommands()
    {

        $commands = Command::whereNotIn('status', [Status::LIVRE, Status::REFUSE])
            ->has('deliveryArticles')
            ->get();

        if ($commands) {

            $commands->map(function ($item, $key) {

                $item->articles()->delete();
                $item->update(['delivery_invoice_id' => null, 'delivery_invoice_uuid' => null]);
            });

            //dd($commands);
        }
    }

    private function updateRefusedCommand()
    {
        $commands = Command::whereIn('status', [Status::REFUSE])
            ->has('deliveryArticles')
            ->get();

        if ($commands) {

            $commands->map(function ($item, $key) {
                $item->deliveryArticles()->update(['price_total' => 0]);
            });
        }
    }

    private function CloseYesterdayInvoice()
    {
        $invoices = DeliveryInvoice::whereDate('created_at', '!=', now()->format('Y-m-d'))
            //->whereDay('created_at', Carbon::yesterday()->format('d'))
            ->where('cloture', false)
            ->select(['id', 'cloture'])->get();
        $invoices->each->update(['cloture' => true]);
        /*$invoices->each(function ($invoice) {
            $invoice->commands()->update(['is_closed' => true]);
        });*/

        $this->clearAllCachedArchive();
    }

    private function deleteNullInvoices()
    {
        $invoices = DeliveryInvoice::doesntHave('deliveryArticles')->get();

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
