<?php

namespace App\Repositories\Bank;

use App\Models\Sameleon\Bank;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class BankRepository extends AppRepository implements BankInterface
{
    private $bank;

    private $instance;

    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    public function __instance(): Bank
    {
        if (! $this->instance) {
            $this->instance = $this->bank;
        }

        return $this->instance;
    }

    /**
     * @return Bank[]|Collection|string[]
     */
    public function getBanks()
    {
        if ($this->useCache()) {
            return $this->setCache()->remember('all_banks_cache', $this->timeToLive(), function () {
                return $this->bank->withCount('users')->get();
            });
        }

        return $this->bank->withCount('users')->get();
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function getBank(int $id)
    {
        return $this->bank->find($id);
    }

    public function getBankByUuid(string $uuid)
    {
        return $this->bank->whereUuid($uuid);
    }

    public function getBankById(int $id)
    {
        return $this->bank->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->bank->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->bank->first();
    }
}
