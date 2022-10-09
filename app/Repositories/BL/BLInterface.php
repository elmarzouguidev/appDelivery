<?php


namespace App\Repositories\BL;

interface BLInterface
{

    public function getBLs();

    public function getBL(int $id);

    public function getBLByUuid(string $uuid);

    public function getBLById(int $id);

    public function select(array $fields);

    public function getFirst();
}
