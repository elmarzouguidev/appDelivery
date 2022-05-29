<?php


namespace App\Repositories\Bill;

interface BillInterface
{


    public function getBills();

    public function getBill(int $id);

    public function getBillByUuid(string $uuid);

    public function getBillById(int $id);

    public function select(array $fields);

    public function getFirst();
}
