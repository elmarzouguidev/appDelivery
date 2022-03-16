<?php


namespace App\Repositories\City;

interface CityInterface
{

    public function getCities();

    public function getCity(int $id);

    public function getCityByUuid(string $uuid);

    public function getCityById(int $id);

    public function select(array $fields);

    public function getFirst();
}
