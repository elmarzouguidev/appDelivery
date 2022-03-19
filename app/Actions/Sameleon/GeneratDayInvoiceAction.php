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

        $this->invoice = Invoice::whereDay('created_at', now()->format('d'))->where('client_id', auth('client')->id())->first();

        if ($this->invoice) {
            $this->addItems();
        } else {
            $this->invoice = new Invoice();
            $this->invoice->client()->associate(auth('client')->id());
            $this->invoice->save();
        }
    }

    private function addItems()
    {

        $commands = auth('client')
            ->user()
            ->commands()
            ->whereStatus(Status::LIVRE)
            ->whereDay('created_at', now()->format('d'))
            ->doesntHave('articles')
            ->withSum('products', 'product_command.price_total')
            ->latest()->get();

        if ($commands) {

            $newCommands =  $commands->map(function ($item, $key) {
                return [
                    'command_id' => $item->id,
                    'code_command' => $item->code,
                    'date_command' => $item->created_at->format('d-m-Y'),
                    'city' => $item->city->name,
                    'status' => 'Livré',
                    'price_total' => $item->products_sum_product_commandprice_total,
                    'frais' => $item->frais,
                ];
            })->toArray();

            // dd($newCommands, $commands);
            //return redirect()->route('public.show.invoice', [$this->invoice->uuid, 'has_header' => true]);

            $this->invoice->articles()->createMany($newCommands);
        }
    }
}
