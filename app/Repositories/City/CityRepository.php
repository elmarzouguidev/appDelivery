<?php


namespace App\Repositories\City;

use App\Models\Client;
use App\Models\Sameleon\City;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class CityRepository extends AppRepository implements CityInterface
{

    private $city;

    private $instance;

    private $options;

    public function __construct(City $city)
    {
        $this->city = $city;

        $this->options = config('app-config');
    }

    public function __instance(): City
    {
        if (!$this->instance) {
            $this->instance = $this->city;
        }

        return $this->instance;
    }


    /**
     * @return Client[]|Collection|string[]
     */
    public function getCities()
    {
        if ($this->useCache()) {
            // dd('yes cache');
            return $this->setCache()->remember('all_cities_cache', $this->timeToLive(), function () {

                return $this->city->all();
            });
        }
        //dd('no cache');
        return $this->city->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCity(int $id)
    {
        return $this->city->find($id);
    }


    public function getCityByUuid(string $uuid)
    {
        return $this->city->whereUuid($uuid);
    }

    public function getCityById(int $id)
    {
        return $this->city->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->city->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->city->first();
    }
}
