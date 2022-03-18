<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Models\Sameleon\Command;
use App\Repositories\City\CityInterface;
use Livewire\Component;
use App\Status\Status;

class Commands extends Component
{

    public $commands;

    public $commandEdit;

    public $showEdit = false;

    public $showEditStatus = false;

    public $cities;

    public function render()
    {

        return view('livewire.sameleon.command.commands');
    }

    public function mount()
    {
        $this->showEdit = false;
    }

    public function editCommand(Command $command)
    {

        $this->showEdit = true;

        $this->cities = app(CityInterface::class)->getCities();

        $this->commandEdit = $command->load('products');

        //dd(  $this->command);
        $this->dispatchBrowserEvent('show-edit');
    }

    public function editStatus(Command $command)
    {

        $this->showEditStatus = true;

        $this->commandEdit = $command;

        $this->dispatchBrowserEvent('show-edit-status');
    }
    public function changeStatus(Command $command, int $status)
    {
        $command->update(['status' => $status]);

        $this->dispatchBrowserEvent('status-updated');
    }
}
