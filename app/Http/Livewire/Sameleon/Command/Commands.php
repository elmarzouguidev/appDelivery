<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Filters\ItemsQuery;
use App\Models\Sameleon\Client;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\User;
use App\Repositories\City\CityInterface;
use Livewire\Component;
use App\Status\Status;

class Commands extends Component
{

    public $commandEdit;

    public $showEdit = false;

    public $showFilters;

    public $class = 'col-12';

    public $showEditStatus = false;

    public $canPolled = false;

    public $cities;

    public $clients;

    public $isRepoted = false;
    public $reportTime;
    public $reportComment;


    public $filter = [];

    public $data = [];

    protected $updatesQueryString = ['filter'];

    protected $rules = [
        'reportTime' => 'required',
        'reportComment' => 'required|string',
    ];


    protected $listeners = ['runPoll','closePoll'];

    public function render()
    {

        $command = new ItemsQuery(new Command, $this->filter);

        if (auth()->user()->hasRole('Client')) {

            $commands =  $command->where('user_id', auth()->id())
                ->withSum('products', 'product_command.price_total')
                ->with(['invoice:uuid,id','city:id,name'])->get();
        } else {

            $commands = $command->withSum('products', 'product_command.price_total')
                ->with(['invoice:uuid,id','city:id,name'])->get();
        }
        //  $commands =  $command->with('products')->get();

        return view('livewire.sameleon.command.commands', compact('commands'));
    }

    public function runPoll()
    {
       $this->canPolled = true;
    }
    public function closePoll()
    {
       $this->canPolled = false;
    }

    public function mount()
    {
        $this->showEdit = false;

        $this->reportTime = now()->format('d-m-Y');

        $this->reportComment = '';
        if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin')) {
            $this->clients = User::role('Client')->select(['nom', 'prenom', 'id'])->get();
        }
    }

    public function showUpFilter()
    {

        $this->class = "col-lg-10";

        $this->showFilters = !$this->showFilters;

        if (!$this->showFilters) $this->class = "col-lg-12";
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

    /********************Filters **************************/

    public function setfilter()
    {

        if (!$this->data) {

            return;
        }

        if ($this->data && array_key_exists('from_to', $this->data) && isset($this->data['from_to']) && !is_string($this->data['from_to'])) {

            $this->data['from_to'] = implode(',', array_reverse($this->data['from_to']));
        }
        $this->data = array_filter(array_map('trim', $this->data));

        $this->filter = $this->data;

        $this->dispatchBrowserEvent('refresh-datatable');
        //$this->data = null;
        // dd($this->data);

    }

    public function resetfilter()
    {
        $this->data = null;

        $this->emit('refresh');
    }
}
