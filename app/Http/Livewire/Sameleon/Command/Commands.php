<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Filters\ItemsQuery;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use App\Repositories\City\CityInterface;
use Livewire\Component;
use App\Status\Status;

class Commands extends Component
{

    public $commandEdit;

    public $showEdit = false;

    public $showFilters;

    public $showEditStatus = false;

    public $canPolled = false;

    public $cities;
    public $citiesList;

    public $clients;
    public $products;

    public $isRepoted = false;
    public $reportTime;
    public $reportComment;


    public $filter = [];

    public $data = [];

    protected $updatesQueryString = ['filter'];

    protected $rules = [
        'reportTime' => 'required',
        'reportComment' => 'nullable|string',
    ];


    protected $listeners = ['runPoll', 'closePoll'];

    public $selectedCommands = [];

    public $selectedDelivery;

    public function hydrate()
    {
        $this->emit('datatable');
    }

    public function render()
    {

        $command = new ItemsQuery(new Command, $this->filter);

        if (auth()->user()->hasRole('Client')) {

            $commands =  $command->where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->withSum('products', 'product_command.price_total')
                ->with('products.stock')
                ->with(['invoice:uuid,id,full_number', 'city:id,name'])
                ->orderByRaw("created_at DESC")
                ->get()->prioritize(function ($item) {
                    return $item->status == Status::LIVRE
                        ||
                        $item->status == Status::ENCOURS;
                });
            $delivries = [];
        } elseif (auth()->user()->hasRole('Delivery')) {
            $commands =  $command->where('delivery_id', auth()->id())
                ->where('delivery_uuid', auth()->user()->uuid)
                ->withSum('products', 'product_command.price_total')
                ->with('products.stock')
                ->with(['city:id,name'])
                ->orderByRaw("created_at DESC")
                ->get();
            $delivries = [];
        } else {

            $commands = $command->withSum('products', 'product_command.price_total')
                ->with(['invoice:uuid,id,full_number', 'city:id,name'])
                ->with('products.stock')
                ->orderByRaw("created_at DESC")
                /* ->get()->map(function ($value, $key) {
                    return $value->status == Status::NON_TRAITE ||
                        $value->status == Status::ENCOURS;
                });*/
                ->get()->prioritize(function ($item) {
                    return $item->status == Status::NON_TRAITE
                        ||
                        $item->status == Status::ENCOURS;
                });
            $delivries = User::role('Delivery')->select(['uuid', 'id', 'nom', 'prenom'])->get();
        }

        //  $commands =  $command->with('products')->get();

        return view('livewire.sameleon.command.commands', compact('commands', 'delivries'));
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
            $this->products = Product::select(['id', 'name'])->get();
            $this->citiesList = app(CityInterface::class)->getCities();
        }
    }

    public function updatedSelectedCommands()
    {
        // dd($this->selectedCommands);
    }

    public function attachToDelivery()
    {
        if (count($this->selectedCommands) && is_int($this->selectedDelivery)); {

            $delivery = User::find($this->selectedDelivery);

            Command::find($this->selectedCommands)->each->update(['delivery_id' => $delivery->id, 'delivery_uuid' => $delivery->uuid]);

            $this->dispatchBrowserEvent('notify-global', ['message' => 'les commands envoyer avec succsé']);

            $this->dispatchBrowserEvent('status-updated');
        }
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
        
        $products = $command->products;

        if ($status == Status::LIVRE) {

            $command->update(['delivered_at' => now()]);

            $products->each(function ($product, $key) use($command) {

                $qteGlobal = $product->stock->qte_rest;

                $qteRest = $qteGlobal - $product->pivot->quantity;

                if ($qteGlobal < $product->pivot->quantity) {

                    $product->stock()->update(['qte_rest' => 0, 'is_out' => true, 'qte_livre' => 0]);

                    $command->update(['status' => Status::MANQUE_DE_STOCK]);

                } else {

                    if ($qteRest < $qteGlobal && $product->stock->qte_livre != $product->stock->qte_global && $product->pivot->quantity > 0) {
                        $product->stock()->increment('qte_livre', $product->pivot->quantity);
                        $product->stock()->update(['qte_rest' => $product->stock->qte_rest - $product->pivot->quantity]);
                    }
                    if ($product->stock->qte_livre == $product->stock->qte_global) {
                        $product->stock()->update(['qte_rest' => 0]);
                    }
                }
            });
        } else {

            $command->update(['delivered_at' => '00:00:00']);

            $products->each(function ($product, $key) {

                if ($product->stock->qte_rest < $product->pivot->quantity) {

                    $product->stock()->update(['qte_rest' => 0, 'is_out' => true]);
                }

                if ($product->stock->qte_livre > 0 && $product->pivot->quantity > 0) {
                    $product->stock()->decrement('qte_livre', $product->pivot->quantity);
                    $product->stock()->update(['qte_rest' => $product->stock->qte_rest + $product->pivot->quantity]);
                }
            });
        }
        
        

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

        $this->dispatchBrowserEvent('refresh-datatable', ['componentName' => '#datatable-buttons']);
        //$this->data = null;
        // dd($this->data);

    }

    public function resetfilter()
    {
        $this->data = null;

        $this->emit('refresh');
    }
}
