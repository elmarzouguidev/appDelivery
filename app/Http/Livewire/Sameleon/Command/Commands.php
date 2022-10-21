<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Filters\ItemsQuery;
use App\Http\Controllers\Sameleon\Admin\Command\PrintController;
use App\Models\Sameleon\BLivraison;
use App\Models\Sameleon\BRouter;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock;
use App\Models\Sameleon\User;
use App\Repositories\City\CityInterface;
use Livewire\Component;
use App\Status\Status;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class Commands extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

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
        'reportTime' => 'required|date',
        'reportComment' => 'nullable|string',
    ];

    protected $listeners = [
        'data:update' => '$refresh',
        'updateStock' => 'updateStock'
    ];

    public $selectedCommands = [];

    public $selectedDelivery;

    public function hydrate()
    {
        $this->emit('datatable');
    }

    public function render()
    {


        if (request()->has('livred') && request()->livred == true) {

            $this->filter += ['status' => Status::LIVRE];

            $this->emit('refresh');
        }
        if (request()->has('encours') && request()->encours == true) {

            $this->filter += ['status' => Status::ENCOURS];

            $this->emit('refresh');
        }

        if (request()->has('pdr') && request()->pdr == true) {

            $this->filter += ['status' => Status::PAS_DE_REPONSE];

            $this->emit('refresh');
        }

        if (request()->has('reported') && request()->reported == true) {

            $this->filter += ['status' => Status::REPORTE];

            $this->emit('refresh');
        }

        if (request()->has('cancled') && request()->cancled == true) {

            $this->filter += ['status' => Status::REFUSE];

            $this->emit('refresh');
        }

        $command = new ItemsQuery(new Command, $this->filter);

        $commandStatus = implode(',', [Status::NON_TRAITE, Status::ENCOURS, Status::REPORTE, Status::REFUSE, Status::LIVRE, Status::RETOURNE]);

        if (isClient()) {

            $commands =  $command->where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->with('items')
                ->withSum('items', 'prix_total')
                ->withCount('invoice')
                ->with(['invoice:uuid,id,full_number,cloture', 'city:id,name'])
                ->orderByRaw("created_at DESC")
                ->orderByRaw("FIELD(status, $commandStatus)")

                ->paginate(60);

            //dd( $commands);
            $delivries = [];
        } elseif (isDelivery()) {

            $commands =  $command->where('delivery_id', delivery()->id)
                ->where('delivery_uuid', delivery()->uuid)
                ->whereIn('status', [Status::ENCOURS, Status::LIVRE])
                //->where('updated_at', now())
                ->with('items')
                ->withSum('items', 'prix_total')
                //->with('products.stock')
                ->with(['city:id,name'])
                ->orderByRaw("created_at DESC")
                ->orderByRaw("FIELD(status, $commandStatus)")
                ->paginate(60);

            $delivries = [];

            return view('livewire.sameleon.command.commands-delivery', compact('commands', 'delivries'));
        } elseif (isDelivery() && delivery()->hasRole('DeliveryEntreprise')) {

            $commands =  $command->where('delivery_id', delivery()->id)
                ->where('delivery_uuid', delivery()->uuid)
                ->whereIn('status', [Status::ENCOURS, Status::LIVRE])
                //->where('updated_at', now())
                ->with('items')
                ->withSum('items', 'prix_total')
                //->with('products.stock')
                //->with(['city:id,name'])
                ->orderByRaw("created_at DESC")
                ->orderByRaw("FIELD(status, $commandStatus)")
                ->paginate(60);

            $delivries = [];

            return view('livewire.sameleon.command.commands-delivery-company', compact('commands', 'delivries'));
        } else {

            $commands = $command
                ->with('items')
                ->withSum('items', 'prix_total')
                ->withCount('invoice')
                ->with(['invoice:uuid,id,full_number,cloture', 'city:id,name', 'delivery:id,nom,prenom', 'client:id,nom,prenom'])
                //->orderByRaw("created_at DESC")
                ->orderBy('is_closed', 'asc')
                ->orderByRaw("FIELD(status, $commandStatus)")
                ->paginate(60);

            $delivries = Delivery::role(['Delivery', 'DeliveryEntreprise'])->select(['uuid', 'id', 'nom', 'prenom', 'type'])->get();
        }

        //  $commands =  $command->with('products')->get();

        return view('livewire.sameleon.command.commands-new', compact('commands', 'delivries'));
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

        $this->emit('refresh');

        $this->showEdit = false;

        $this->reportTime = now()->format('d-m-Y');

        $this->reportComment = '';

        if (isAdmin()) {

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

            $delivery = Delivery::find($this->selectedDelivery);

            $status = $delivery->city_id == 1 ? Status::ENCOURS : Status::EXPEDIE; // city_id 1 == casablanca

            Command::find($this->selectedCommands)->each->update([

                'delivery_id' => $delivery->id,
                'delivery_uuid' => $delivery->uuid,
                'status' => $status

            ]);

            $this->dispatchBrowserEvent('notify-global', ['message' => 'les commands envoyer avec succès']);

            $this->dispatchBrowserEvent('status-updated');
        }
    }

    public function generateBl()
    {
        if (count($this->selectedCommands)) {


            $commands = Command::withSum('items', 'prix_total')->find($this->selectedCommands)->each->get();

            $bon = new BLivraison();
            $bon->city_id = $commands[0]->city_id;
            $bon->city_uuid = $commands[0]->city_uuid;
            $bon->delivery_id = $commands[0]->delivery_id;
            $bon->delivery_uuid = $commands[0]->delivery_uuid;
            $bon->bon_date = now();
            $bon->save();

            if ($bon && $commands) {
                $newCommands =  $commands->map(function ($item, $key) use ($bon) {

                    //$item->update(['invoice_id' => $this->invoice->id, 'invoice_uuid' => $this->invoice->uuid]);

                    //$price = $item->status == Status::REFUSE ? 0 : $item->items_sum_prix_total;
                    return [
                        'b_livraison_id' => $bon->id,
                        'b_livraison_uuid' => $bon->uuid,
                        'command_id' => $item->id,
                        'command_uuid' => $item->uuid,
                        'command_status' => $item->status,
                        'phone' => $item->client_phone,
                        'name' => $item->client_name,
                        'address' => $item->client_address,
                        'price_total' => $item->items_sum_prix_total,
                        'bon_date' => $item->created_at->format('d-m-Y'),
                    ];
                })->toArray();

                $bon->articles()->createMany($newCommands);
            }
            if ($bon && $bon->articles()->count()) {
                $this->dispatchBrowserEvent('notify-global', ['message' => 'le bon a été generer avec succès']);
                $this->dispatchBrowserEvent('bl-redirect');
            }
        }
    }

    public function generateBR()
    {
        if (count($this->selectedCommands)) {


            $commands = Command::withSum('items', 'prix_total')->find($this->selectedCommands)->each->get();

            $bon = new BRouter();
            $bon->city_id = $commands[0]->city_id;
            $bon->city_uuid = $commands[0]->city_uuid;
            $bon->bon_date = now();
            $bon->save();

            if ($bon && $commands) {
                $newCommands =  $commands->map(function ($item, $key) use ($bon) {

                    //$item->update(['invoice_id' => $this->invoice->id, 'invoice_uuid' => $this->invoice->uuid]);

                    //$price = $item->status == Status::REFUSE ? 0 : $item->items_sum_prix_total;
                    return [
                        'b_router_id' => $bon->id,
                        'b_router_uuid' => $bon->uuid,
                        'command_id' => $item->id,
                        'command_uuid' => $item->uuid,
                        'command_status' => $item->status,
                        'phone' => $item->client_phone,
                        'name' => $item->client_name,
                        'address' => $item->client_address,
                        'price_total' => $item->items_sum_prix_total,
                        'bon_date' => $item->created_at->format('d-m-Y'),
                    ];
                })->toArray();

                $bon->articles()->createMany($newCommands);
            }
            if ($bon && $bon->articles()->count()) {
                $this->dispatchBrowserEvent('notify-global', ['message' => 'le bon a été generer avec succès']);
                $this->dispatchBrowserEvent('br-redirect');
            }
        }
    }

    public function printCommands()
    {
        if (count($this->selectedCommands)) {

            //$commands = Command::withSum('items', 'prix_total')->find($this->selectedCommands)->each->get();
            //$command = Command::withSum('items', 'prix_total')->find($this->selectedCommands)->first();

            //return app(PrintController::class)->getCommands($command);
            return redirect()->route('admin:commands.print',$this->selectedCommands);
        }  
    }

    public function editCommand(Command $command)
    {

        //dd('fff');
        $this->showEdit = true;

        $this->cities = app(CityInterface::class)->getCities();

        $this->commandEdit = $command->load('items')->loadSum('items', 'prix_total');

        //dd($this->commandEdit);

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

        //dd('Ooow');
        $items = $command->items;

        if ($status == Status::LIVRE && $command->status != Status::LIVRE) {

            $items->each(function ($item, $key) use ($command, $status) {

                $prod = Product::find($item->product_id);

                if ($prod) {

                    $qte = (int)$item->quantity;

                    $stock = $prod->stocks()->where([
                        'city_id' => $command->city_id,
                        'city_uuid' => $command->city_uuid,
                    ])->first();

                    //dd($stock);


                    if ($stock->qte_rest >= $qte && $stock->qte_rest !== 0 && $stock->qte_rest > 0 && !$stock->is_out) {

                        //dd('Oui in this cas ');

                        $stock->decrement('qte_rest', $qte);

                        $stock->increment('qte_livre', $qte);

                        $command->update(['delivered_at' => now()]);

                        $command->update(['status' => $status]);
                    } else {

                        $stock->update(['is_out' => true]);

                        $command->update(['delivered_at' => null]);

                        $command->update(['status' => Status::MANQUE_DE_STOCK]);
                    }
                } else {
                }
            });
        } elseif ($status == Status::REFUSE && $command->status != Status::REFUSE) {

            $command->update(['delivered_at' => '1993-03-03 00:00:00']);

            $items->each(function ($item, $key) use ($command, $status) {

                $prod = Product::find($item->product_id);

                if ($prod) {

                    $qte = (int)$item->quantity;

                    $stock = $prod->stocks()->where([
                        'city_id' => $command->city_id,
                        'city_uuid' => $command->city_uuid,
                    ])->first();

                    if ($stock->qte_rest !== 0 && $stock->qte_rest > 0 || $stock->qte_rest >= $qte) {

                        $stock->increment('qte_rest', $qte);
                        $stock->decrement('qte_livre',  $qte);
                    }

                    $command->update(['status' => $status]);

                    if ($stock->qte_rest == 0) {

                        $stock->update(['is_out' => true]);

                        $command->update(['status' => Status::MANQUE_DE_STOCK]);
                    }
                } else {
                }
            });
        } else {

            $command->update(['status' => $status]);
        }


        $this->isRepoted = true;

        if (isAdmin()) {

            if ($this->commandEdit->reported_at != null) {

                $this->reportTime = $this->commandEdit->reported_at->format('d-m-Y');
            }

            $this->reportComment =  str_replace('<br />', '', $this->commandEdit->comment);

            $this->dispatchBrowserEvent('status-reported');
        }

        if (isDelivery()) {

            $this->dispatchBrowserEvent('status-updated');

            $this->dispatchBrowserEvent('notify-change');
        }

        //$this->dispatchBrowserEvent('status-updated');
    }

    public function saveReportDetail()
    {

        $this->validate();

        $reportedDate = null;

        if ($this->commandEdit->status == Status::REPORTE) {

            //$this->commandEdit->update(['comment' => null, 'reported_at' => null]);

            $reportedDate = Carbon::createFromFormat('d-m-Y', $this->reportTime)->format('Y-m-d');
        }

        $this->commandEdit->update(['comment' => $this->reportComment, 'reported_at' => $reportedDate]);

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
        //$this->emit('data:update');
        $this->emit('refresh');
    }

    public function resetfilter()
    {
        $this->data = null;

        $this->emit('refresh');
    }
}
