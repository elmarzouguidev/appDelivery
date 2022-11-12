<?php


namespace App\Repositories\BR;


use App\Models\Sameleon\BRouter;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class BRRepository extends AppRepository implements BRInterface
{

    private $br;

    private $instance;

    private $options;

    public function __construct(BRouter $br)
    {
        $this->br = $br;

        $this->options = config('app-config');
    }

    public function __instance(): BRouter
    {
        if (!$this->instance) {
            $this->instance = $this->br;
        }

        return $this->instance;
    }


    /**
     * @return BRouter[]|Collection|string[]
     */
    public function getBRs()
    {
        if(isClient())
        {
            return $this->br
            ->where('user_id',auth()->id())
            ->where('user_uuid',auth()->user()->uuid)
            ->with('articles')->with('city:id,name')->get();

        }
        return $this->br->with('articles')->with('city:id,name')->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getBR(int $id)
    {
        return $this->br->find($id);
    }


    public function getBRByUuid(string $uuid)
    {
        return $this->br->whereUuid($uuid);
    }

    public function getBRById(int $id)
    {
        return $this->br->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->br->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->br->first();
    }
}
