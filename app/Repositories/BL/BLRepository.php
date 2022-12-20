<?php

namespace App\Repositories\BL;

use App\Models\Sameleon\BLivraison;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class BLRepository extends AppRepository implements BLInterface
{
    private $bl;

    private $instance;

    private $options;

    public function __construct(BLivraison $bl)
    {
        $this->bl = $bl;

        $this->options = config('app-config');
    }

    public function __instance(): BLivraison
    {
        if (! $this->instance) {
            $this->instance = $this->bl;
        }

        return $this->instance;
    }

    /**
     * @return BLivraison[]|Collection|string[]
     */
    public function getBLs()
    {
        if (isDelivery()) {
            return $this->bl
                ->where('delivery_id', delivery()->id)
                ->where('delivery_uuid', delivery()->uuid)
                ->with('articles')->with('city:id,name')->get();
        }

        return $this->bl->with('articles')->with('city:id,name')->get();
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function getBL(int $id)
    {
        return $this->bl->find($id);
    }

    public function getBLByUuid(string $uuid)
    {
        return $this->bl->whereUuid($uuid);
    }

    public function getBLById(int $id)
    {
        return $this->bl->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->bl->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->bl->first();
    }
}
