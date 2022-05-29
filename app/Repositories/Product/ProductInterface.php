<?php


namespace App\Repositories\Product;

interface ProductInterface
{


    public function getProducts();

    public function getProduct(int $id);

    public function getProductByUuid(string $uuid);

    public function getProductById(int $id);

    public function select(array $fields);

    public function getFirst();
}
