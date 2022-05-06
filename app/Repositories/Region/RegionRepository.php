<?php


namespace App\Repositories\Region;


use App\Models\Sameleon\Region;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class RegionRepository extends AppRepository implements RegionInterface
{

    private $region;

    private $instance;

    private $options;

    public function __construct(Region $region)
    {
        $this->region = $region;

        $this->options = config('app-config');
    }

    public function __instance(): Region
    {
        if (!$this->instance) {
            $this->instance = $this->region;
        }

        return $this->instance;
    }


    /**
     * @return Client[]|Collection|string[]
     */
    public function getRegions()
    {
        if ($this->useCache()) {
            // dd('yes cache');
            return $this->setCache()->remember('all_regions_cache', $this->timeToLive(), function () {

                return $this->region->all();
            });
        }
        //dd('no cache');
        return $this->region->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getRegion(int $id)
    {
        return $this->region->find($id);
    }


    public function getRegionByUuid(string $uuid)
    {
        return $this->region->whereUuid($uuid);
    }

    public function getRegionById(int $id)
    {
        return $this->region->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->region->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->region->first();
    }
}
