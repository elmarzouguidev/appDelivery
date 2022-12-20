<?php

namespace App\Repositories\Delivery;

interface DeliveryInterface
{
    public function getDeliveries();

    public function getDeliveryEntreprise();

    public function getDelivery(int $id);

    public function getDeliveryByUuid(string $uuid);

    public function getDeliveryById(int $id);

    public function select(array $fields);

    public function getFirst();
}
