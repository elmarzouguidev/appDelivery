<?php


namespace App\Repositories\Stock;

interface StockInterface
{


    public function getStocks();

    public function getStocksForDelivery();

    public function getStock(int $id);

    public function getStockByUuid(string $uuid);

    public function getStockById(int $id);

    public function select(array $fields);

    public function getFirst();
}
