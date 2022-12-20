<?php

namespace App\Repositories\Bank;

interface BankInterface
{
    public function getBanks();

    public function getBank(int $id);

    public function getBankByUuid(string $uuid);

    public function getBankById(int $id);

    public function select(array $fields);

    public function getFirst();
}
