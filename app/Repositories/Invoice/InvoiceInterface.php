<?php

namespace App\Repositories\Invoice;

interface InvoiceInterface
{
    public function getInvoices();

    public function getInvoice(int $id);

    public function getInvoiceByUuid(string $uuid);

    public function getInvoiceById(int $id);

    public function select(array $fields);

    public function getFirst();
}
