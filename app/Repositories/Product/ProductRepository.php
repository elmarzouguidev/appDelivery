<?php


namespace App\Repositories\Product;

use App\Models\Sameleon\Product;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends AppRepository implements ProductInterface
{

    private $product;

    private $instance;

    private $options;

    public function __construct(Product $product)
    {
        $this->product = $product;

        $this->options = config('app-config');
    }

    public function __instance(): Product
    {
        if (!$this->instance) {
            $this->instance = $this->product;
        }

        return $this->instance;
    }


    /**
     * @return Product[]|Collection|string[]
     */
    public function getProducts()
    {
        if ($this->useCache()) {
            // dd('yes cache');
            return $this->setCache()->remember('all_products_cache', $this->timeToLive(), function () {

                return $this->product->get();
            });
        }
        //dd('no cache');
        return $this->product->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getProduct(int $id)
    {
        return $this->product->find($id);
    }


    public function getProductByUuid(string $uuid)
    {
        return $this->product->whereUuid($uuid);
    }

    public function getProductById(int $id)
    {
        return $this->product->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->product->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->product->first();
    }
}
