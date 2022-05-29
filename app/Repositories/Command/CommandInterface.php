<?php


namespace App\Repositories\Command;

interface CommandInterface
{


    public function getCommands();

    public function getArchivedCommands();

    public function getCommand(int $id);

    public function getCommandByUuid(string $uuid);

    public function getCommandById(int $id);

    public function select(array $fields);

    public function getFirst();
}
