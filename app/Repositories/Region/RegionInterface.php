<?php

namespace App\Repositories\Region;

interface RegionInterface
{
    public function getRegions();

    public function getRegion(int $id);

    public function getRegionByUuid(string $uuid);

    public function getRegionById(int $id);

    public function select(array $fields);

    public function getFirst();
}
