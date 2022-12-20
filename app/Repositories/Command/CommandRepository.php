<?php

namespace App\Repositories\Command;

use App\Models\Sameleon\Command;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class CommandRepository extends AppRepository implements CommandInterface
{
    private $command;

    private $instance;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function __instance(): Command
    {
        if (! $this->instance) {
            $this->instance = $this->command;
        }

        return $this->instance;
    }

    /**
     * @return Command[]|Collection|string[]
     */
    public function getCommands()
    {
        if ($this->useCache()) {
            // dd('yes cache');
            return $this->setCache()->remember('all_commands_cache', $this->timeToLive(), function () {
                return $this->command->get();
            });
        }
        //dd('no cache');
        return $this->command->get();
    }

    /**
     * @return Command[]|Collection|string[]
     */
    public function getArchivedCommands()
    {
        if (isClient()) {
            $cacheKey = 'all_commands_archived_cache_'.auth()->user()->uuid;

            return $this->setCache()->remember($cacheKey, $this->timeToLive(), function () {
                return $this->command
                    ->where('user_id', auth()->id())
                    ->where('user_uuid', auth()->user()->uuid)
                    ->where('is_closed', true)
                    ->with('items', 'city:id,name')
                    ->withSum('items', 'prix_total')
                    ->get();
            });
        } elseif (isDelivery()) {
            $cacheKey = 'all_delivery_commands_archived_cache_'.delivery()->uuid;

            return $this->setCache()->remember($cacheKey, $this->timeToLive(), function () {
                return $this->command
                    ->where('delivery_id', delivery()->id)
                    ->where('delivery_uuid', delivery()->uuid)
                    ->where('is_closed', true)
                    ->with('items', 'city:id,name')
                    ->withSum('items', 'prix_total')
                    ->get();
            });
        } else {
            return $this->setCache()->remember('all_commands_archived_cache', $this->timeToLive(), function () {
                return $this->command
                    ->where('is_closed', true)
                    ->with('client:id,nom,prenom', 'items', 'city:id,name')
                    ->withSum('items', 'prix_total')
                    ->get();
            });
        }
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function getCommand(int $id)
    {
        return $this->command->find($id);
    }

    public function getCommandByUuid(string $uuid)
    {
        return $this->command->whereUuid($uuid);
    }

    public function getCommandById(int $id)
    {
        return $this->command->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->command->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->command->first();
    }
}
