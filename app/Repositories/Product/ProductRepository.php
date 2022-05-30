<?php


namespace App\Repositories\Product;

use App\Models\Sameleon\Product;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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

            if (auth()->user()->hasRole('Client')) {

                $cacheKey = "all_products_cache_" . auth()->user()->uuid;

                return $this->setCache()->remember($cacheKey, $this->timeToLive(), function () {

                    return $this->product
                        ->where('user_id', auth()->id())
                        ->where('user_uuid', auth()->user()->uuid)
                        ->with('media', 'stockMutations')
                        ->get();
                });
            } else {
                return $this->setCache()->remember('all_products_cache', $this->timeToLive(), function () {
                    return $this->product->with('media', 'client:id,nom,prenom')
                        ->with(['stockMutations.stockable' => function (MorphTo $morphTo) {
                            $morphTo->morphWith([$this->product]);
                        }])

                        ->get();
                });
            }
        } else {
            if (auth()->user()->hasRole('Client')) {

                return $this->product
                    ->where('user_id', auth()->id())
                    ->where('user_uuid', auth()->user()->uuid)
                    ->with('media')->get();
            } else {

                return $this->product->with('media', 'client:id,nom,prenom', 'stockMutations')->get();
            }
        }
        return [];
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
