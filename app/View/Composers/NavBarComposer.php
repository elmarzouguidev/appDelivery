<?php

namespace App\View\Composers;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\DeliveryInvoice;
use App\Models\Sameleon\Invoice;
use App\Models\Sameleon\Reclamation;
use Illuminate\Cache\CacheManager;
use Illuminate\View\View;

class NavBarComposer
{
    protected Command $command;

    protected Reclamation $reclamation;

    protected Invoice $invoice;

    protected DeliveryInvoice $deliverInvoice;

    protected CacheManager $cache;

    public function __construct(Command $command, Reclamation $reclamation, Invoice $invoice, DeliveryInvoice $deliverInvoice, CacheManager $cache)
    {
        $this->command = $command;

        $this->reclamation = $reclamation;

        $this->invoice = $invoice;

        $this->deliverInvoice = $deliverInvoice;

        $this->cache = $cache;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('total_new_command', $this->command->totalNewCommands());
        $view->with('total_new_reclamations', $this->reclamation->totalNewReclamations());
        $view->with('invoice_non_closed', $this->invoice->invoiceNonClosed());

        $view->with('delivery_total_new_invoice', $this->deliverInvoice->invoiceNonClosed());

        /*$view->with('categoriesMenu', $this->cache->remember('categoriesMenu', $this->timeToLive(), function () {
             return $this->categories->categoryInMenu();
         })); */
    }

    private function timeToLive()
    {
        return \Carbon\Carbon::now()->addDays(30);
    }
}
