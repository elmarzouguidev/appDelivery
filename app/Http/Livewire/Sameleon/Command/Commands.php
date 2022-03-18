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

    public $isRepoted = false;
    public $reportTime;
    public $reportComment;

    protected $rules = [
        'reportTime' => 'required',
        'reportComment' => 'required|string',
    ];

    public function render()
    {

        return view('livewire.sameleon.command.commands');
    }

    public function mount()
    {
        $this->showEdit = false;

        $this->reportTime = now()->format('d-m-Y');

        $this->reportComment = '';
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

        $this->isRepoted = true;

        if ($this->commandEdit->comments()->latest()->count()) {

            $this->reportTime = $this->commandEdit->comments()->latest()->value('reported_at')->format('d-m-Y');
            $this->reportComment = $this->commandEdit->comments()->latest()->value('content');
        }

        //dd($this->reportTime,$this->reportComment);

        $this->dispatchBrowserEvent('status-reported');


        //$this->dispatchBrowserEvent('status-updated');
    }

    public function saveReportDetail()
    {
        $this->validate();
        // dd($this->reportComment, "---", $this->reportTime, '***', $this->commandEdit);
        $this->commandEdit->comments()->updateOrCreate(['commentable_id' => $this->commandEdit->id], [
            'user_id' => auth()->id(),
            'content' => $this->reportComment,
            'reported_at' => $this->reportTime,
        ]);

        $this->dispatchBrowserEvent('notify-change');

        $this->dispatchBrowserEvent('status-updated');
    }
}
