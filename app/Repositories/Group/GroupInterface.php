<?php


namespace App\Repositories\Group;

interface GroupInterface
{


    public function getGroups();

    public function getGroup(int $id);

    public function getGroupByUuid(string $uuid);

    public function getGroupById(int $id);

    public function select(array $fields);

    public function getFirst();
}
