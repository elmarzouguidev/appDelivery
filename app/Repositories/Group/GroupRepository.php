<?php


namespace App\Repositories\Group;

use App\Models\Sameleon\Group;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository extends AppRepository implements GroupInterface
{

    private $group;

    private $instance;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function __instance(): Group
    {
        if (!$this->instance) {
            $this->instance = $this->group;
        }

        return $this->instance;
    }

    /**
     * @return Group[]|Collection|string[]
     */
    public function getGroups()
    {
        if ($this->useCache()) {

            return $this->setCache()->remember('all_groups_cache', $this->timeToLive(), function () {

                return $this->group
                    ->with('moderator:id,nom,prenom')
                    ->get();
            });
        } else {

            return $this->group
                ->with('moderator:id,nom,prenom')
                ->get();
        }
        return [];
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getGroup(int $id)
    {
        return $this->group->find($id);
    }


    public function getGroupByUuid(string $uuid)
    {
        return $this->group->whereUuid($uuid);
    }

    public function getGroupById(int $id)
    {
        return $this->group->whereId($id);
    }

    public function select(array $fields)
    {
        return $this->group->select($fields);
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->group->first();
    }
}
