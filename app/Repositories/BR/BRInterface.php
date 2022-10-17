<?php


namespace App\Repositories\BR;

interface BRInterface
{

    public function getBRs();

    public function getBR(int $id);

    public function getBRByUuid(string $uuid);

    public function getBRById(int $id);

    public function select(array $fields);

    public function getFirst();
}