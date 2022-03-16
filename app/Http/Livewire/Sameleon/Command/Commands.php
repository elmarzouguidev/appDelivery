<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Models\Sameleon\Command;
use Livewire\Component;

class Commands extends Component
{

    public $commands;

    public $commandEdit;

    public $showEdit = false;

    public $showEditStatus = false;

    public function render()
    {
        
        return view('theme.livewire.sameleon.command.commands');
    }

    public function mount()
    {
        $this->showEdit = false;
    }

    public function editCommand(Command $command)
    {

        $this->showEdit = true;

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
}
