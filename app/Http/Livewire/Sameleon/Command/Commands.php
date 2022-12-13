<?php

namespace App\Http\Livewire\Sameleon\Command;

use App\Filters\ItemsQuery;
use App\Http\Controllers\Sameleon\Admin\Command\PrintController;
use App\Models\Sameleon\BLivraison;
use App\Models\Sameleon\BRouter;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\Item;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Stock;
use App\Models\Sameleon\User;
use App\Repositories\City\CityInterface;
use App\Repositories\Region\RegionInterface;
use App\Status\DeliveryStatus;
use Livewire\Component;
use App\Status\Status;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class Commands extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $commandStatus;

    public $commandEdit;

    public $showEdit = false;

    public $showFilters;

    public $showEditStatus = false;

    public $canPolled = false;

    public $cities;
    public $citiesList;

    public $regions;

    public $blCity;
    public $blDelivery;
    public $blDeliveries;

    public $brClient;

    public $clients;
    public $products;


    public $reportTime;
    public $reportComment;


    public $filter = [];

    public $data = [];

    protected $updatesQueryString = ['filter'];


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

    protected function rules()
    {
        return  [
            'reportTime' => 'required|date',
            'reportComment' => 'nullable|string',
            'commandStatus' => ['nullable', 'integer', Rule::in(Status::getStatus())],
        ];
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

        $commandStatus = implode(',', [Status::NON_TRAITE, Status::ENCOURS, Status::REPORTE, Status::EXPEDIE, Status::REFUSE, Status::RETOURNE, Status::MANQUE_DE_STOCK, Status::LIVRE]);

        if (isClient()) {

            $commands =  $command->where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->with('items')
                ->withSum('items', 'prix_total')
                ->withCount('invoice')
                ->with(['invoice:uuid,id,full_number,cloture', 'city:id,name', 'region:id,name'])
                ->with('tags:id,name')
                ->orderByRaw("FIELD(status, $commandStatus)")
                ->orderByRaw("created_at DESC")
                ->paginate(60);

            $delivries = [];
        } else {

            $commands = $command
                ->with('items')
                ->withSum('items', 'prix_total')
                ->withCount('invoice')
                ->with(['invoice:uuid,id,full_number,cloture', 'city:id,name', 'region:id,name', 'delivery:id,nom,prenom', 'client:id,nom,prenom'])
                //->orderByRaw("created_at DESC")
                ->with('tags:id,name')
                ->orderBy('is_closed', 'asc')
                ->orderByRaw("FIELD(status, $commandStatus)")
                ->orderByRaw("created_at DESC")
                ->paginate(60);

            $delivries = Delivery::role(['Delivery', 'DeliveryEntreprise'])->select(['uuid', 'id', 'nom', 'prenom', 'type'])->get();
        }

        return view('livewire.sameleon.command.commands-new', compact('commands', 'delivries'));
    }

    /*public function updatedCommandStatus($value)
    {
        dd($value);
    }*/

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

        $this->commandStatus = Status::NON_TRAITE;

        $this->blDelivery = null;
        $this->blDeliveries = [];

        $this->brClient = null;

        $this->showEdit = false;

        $this->reportTime = now()->format('d-m-Y');

        $this->reportComment = '';

        if (isAdmin()) {

            $this->clients = User::role('Client')->select(['nom', 'prenom', 'id', 'uuid'])->get();
            $this->products = Product::select(['id', 'name'])->get();
            $this->citiesList = app(CityInterface::class)->getCities();
            $this->regions = app(RegionInterface::class)->getRegions();
        }
    }

    public function updatedData($value)
    {
        // dd($value);
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

            $allCommands = Command::find($this->selectedCommands)->each->get();

            $commands = $allCommands->each(function ($command, $key) use ($delivery) {

                if ($command->city?->id !== $delivery->city?->id) {
                    $this->dispatchBrowserEvent('commands-error-city', ['command' => $command->code, 'city' => $delivery->city?->name]);

                    throw ValidationException::withMessages([
                        'command_listed_error' => "Le livreur 
                        ( {$delivery->full_name} ) ne correspond pas a la ville  ( {$delivery->city?->name} )!"

                    ]);
                    exit;
                }
            });

            $commands->each->update([

                'delivery_id' => $delivery->id,
                'delivery_uuid' => $delivery->uuid,
                'status' => $status,
                'delivery_status' => DeliveryStatus::D_NON_TRAITE

            ]);

            $this->dispatchBrowserEvent('notify-global', ['message' => 'les commands envoyer avec succès']);

            $this->dispatchBrowserEvent('status-updated');
        }
    }


    public function updatedBlCity()
    {

        $deliveries = Delivery::whereCityUuid($this->blCity)->get();

        $this->blDeliveries = $deliveries;
    }


    public function generateBl()
    {
        $commandCity = City::whereUuid($this->blCity)->first();

        $commandDelivery = Delivery::whereUuid($this->blDelivery)->first();

        if (count($this->selectedCommands) && $commandCity && $commandDelivery) {

            $allCommands = Command::withSum('items', 'prix_total')->find($this->selectedCommands)->each->get();

            $commands = $allCommands->each(function ($command, $key) use ($commandCity) {

                if (!$command->city()->is($commandCity)) {
                    $this->dispatchBrowserEvent('commands-error-city', ['command' => $command->code, 'city' => $commandCity->name]);

                    throw ValidationException::withMessages([
                        'command_listed_error' => "La command 
                        ( {$command->code} ) ne correspond pas a la ville ( {$commandCity->name} )!"

                    ]);
                    exit;
                }
            });

            $bon = new BLivraison();
            $bon->city_id = $commandCity->id;
            $bon->city_uuid = $commandCity->uuid;
            $bon->delivery_id = $commandDelivery->id;
            $bon->delivery_uuid = $commandDelivery->uuid;
            $bon->bon_date = now();
            $bon->save();

            if ($bon && $commands) {
                $newCommands =  $commands->map(function ($item, $key) use ($bon) {

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
                $this->dispatchBrowserEvent('notify-global', ['message' => 'Le bon a été generer avec succès']);
                $this->dispatchBrowserEvent('bl-redirect');
            }
        }
    }

    public function generateBR()
    {
        $client = User::role('Client')->whereUuid($this->brClient)->first();

        if (count($this->selectedCommands) && $client) {

            $allCommands = Command::withSum('items', 'prix_total')->find($this->selectedCommands)->each->get();

            $commands = $allCommands->each(function ($command, $key) use ($client) {

                if (!$command->client()->is($client)) {
                    $this->dispatchBrowserEvent('commands-error-client', ['command' => $command->code, 'client' => $client->full_name]);

                    throw ValidationException::withMessages([
                        'command_listed_error' => "La command 
                        ( {$command->code} ) ne correspond pas a le client ( {$client->full_name} )!"

                    ]);
                    exit;
                }
                if ($command->status !== Status::RETOURNE) {
                    $this->dispatchBrowserEvent('commands-error-status', ['command' => $command->code, 'status' => 'Retourné']);

                    throw ValidationException::withMessages([
                        'command_listed_error' => "La command 
                        ( {$command->code} ) ne correspond pas a le status Retourné !"

                    ]);
                    exit;
                }
            });

            $bon = new BRouter();
            $bon->user_id = $client->id;
            $bon->user_uuid = $client->uuid;
            $bon->bon_date = now();
            $bon->save();

            if ($bon && $commands) {
                $newCommands =  $commands->map(function ($item, $key) use ($bon) {

                    return [
                        'b_router_id' => $bon->id,
                        'b_router_uuid' => $bon->uuid,
                        'command_id' => $item->id,
                        'command_uuid' => $item->uuid,
                        'command_status' => $item->status,
                        'phone' => $item->client_phone,
                        'name' => $item->client_name,
                        'city' => optional($item->city)->name ?? null,
                        'address' => $item->client_address,
                        'price_total' => $item->items_sum_prix_total,
                        'bon_date' => $item->created_at->format('d-m-Y'),
                    ];
                })->toArray();

                $bon->articles()->createMany($newCommands);
            }
            if ($bon && $bon->articles()->count()) {
                $this->dispatchBrowserEvent('notify-global', ['message' => 'Le bon de retour a été generer avec succès']);
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
            return redirect()->route('admin:commands.print', $this->selectedCommands);
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

        $this->reportComment =  str_replace('<br />', '', $command->comment);

        $this->dispatchBrowserEvent('show-edit-status');
    }

    public function livredBy(Command $command, $user)
    {

        if ($command) {

            $delivred = $command->delivred_by ?? [];

            if ($user && !in_array($user, $delivred)) {

                $delivred_by = array_merge(
                    $delivred,
                    [$user]
                );

                $command->update(['delivred_by' => $delivred_by]);
            }
        }
        return redirect()->back();
    }

    public function changeStatus(Command $command)
    {

        $items = $command->items;

        $status = $this->commandStatus;

        if ($status == Status::LIVRE && $command->status != Status::LIVRE) {

            $items->each(function ($item, $key) use ($command, $status) {

                $prod = Product::find($item->product_id);

                if ($prod) {

                    $qte = (int)$item->quantity;

                    $stock = $prod->stocks()->where([
                        'city_id' => $command->city_id,
                        'city_uuid' => $command->city_uuid,
                    ])->first();

                    if ($stock) {
                        if ($stock->qte_rest >= $qte && $stock->qte_rest !== 0 && $stock->qte_rest > 0 && !$stock->is_out) {

                            $stock->decrement('qte_rest', $qte);
                            $stock->increment('qte_livre', $qte);

                            $prod->decrement('qte_rest', $qte);
                            $prod->increment('qte_livre', $qte);

                            $command->update(['delivered_at' => now()]);

                            $command->update(['status' => $status]);

                            if ($stock->qte_rest === 0) {
                                $stock->update(['is_out' => true]);
                            }
                            if ($prod->qte_rest === 0) {
                                $prod->update(['is_out' => true]);
                            }

                            $this->livredBy($command, auth()->user()->id);
                        } else {

                            //$stock->update(['is_out' => true]);

                            $command->update(['delivered_at' => null]);

                            $command->update(['status' => Status::MANQUE_DE_STOCK]);

                            if ($stock->qte_rest === 0) {
                                $stock->update(['is_out' => true]);
                            }
                            if ($prod->qte_rest === 0) {
                                $prod->update(['is_out' => true]);
                            }
                        }
                    } else {
                        $CityName = $command->city?->name;

                        $this->dispatchBrowserEvent('stock-not-found-city', ['city' => $CityName, 'product' => $prod->name]);

                        throw ValidationException::withMessages([
                            'stock_not_found' => "Le stock de ($prod->name) n'existe pas sur la ville $CityName!"
                        ]);
                        exit;
                    }
                } else {

                    $CityName = optional($command->city)->name;

                    $this->dispatchBrowserEvent('product-not-found', ['product' => $item->product]);

                    throw ValidationException::withMessages([
                        'stock_not_found' => "Le produit ($item->product) n'existe pas sur le systeme !"
                    ]);
                    exit;
                }
            });
        } elseif ($status == Status::REFUSE && $command->status == Status::LIVRE && $command->status != Status::REFUSE) {

            $command->update(['delivered_at' => '1993-03-03 00:00:00']);

            $command->update(['status' => $status]);

            $items->each(function ($item, $key) use ($command, $status) {

                $prod = Product::find($item->product_id);

                if ($prod) {

                    $qte = (int)$item->quantity;

                    $stock = $prod->stocks()->where([
                        'city_id' => $command->city_id,
                        'city_uuid' => $command->city_uuid,
                    ])->first();

                    if ($stock) {
                        if ($stock->qte_rest !== 0 && $stock->qte_rest > 0 || $stock->qte_rest >= $qte) {

                            $stock->increment('qte_rest', $qte);
                            $stock->decrement('qte_livre',  $qte);

                            $prod->increment('qte_rest', $qte);
                            $prod->decrement('qte_livre', $qte);
                        }

                        if ($stock->qte_rest == 0) {

                            $stock->update(['is_out' => true]);

                            $command->update(['status' => Status::MANQUE_DE_STOCK]);
                        }
                        if ($prod->qte_rest === 0) {
                            $prod->update(['is_out' => true]);
                        }
                    } else {

                        $CityName = optional($command->city)->name;
                        $this->dispatchBrowserEvent('stock-not-found-city', ['city' => $CityName]);

                        throw ValidationException::withMessages([
                            'stock_not_found' => "Le stock n'existe pas sur la ville $CityName !"
                        ]);
                        exit;
                    }
                } else {
                }
            });
        } else {

            if ($command->status == Status::LIVRE) {

                $this->rollBackStatus($command, $items);
            }
            $command->update(['status' => $status]);
        }


        if ($command->reported_at != null) {

            $this->reportTime = $command->reported_at->format('d-m-Y');
        }

        $this->saveReportDetail($command);
    }

    public function saveReportDetail(Command $command)
    {

        $this->validate();

        $reportedDate = null;

        if ($command->status == Status::REPORTE) {

            //$this->commandEdit->update(['comment' => null, 'reported_at' => null]);

            $reportedDate = Carbon::createFromFormat('d-m-Y', $this->reportTime)->format('Y-m-d');
        }

        $command->update(['comment' => $this->reportComment, 'reported_at' => $reportedDate]);

        $this->dispatchBrowserEvent('notify-change');

        $this->dispatchBrowserEvent('status-updated');
    }

    private function rollBackStatus(Command $command, Collection $items)
    {
        $items->each(function ($item, $key) use ($command) {

            $prod = Product::find($item->product_id);

            if ($prod) {

                $qte = (int)$item->quantity;

                $stock = $prod->stocks()->where([
                    'city_id' => $command->city_id,
                    'city_uuid' => $command->city_uuid,
                ])->first();

                if ($stock) {

                    $stock->increment('qte_rest', $qte);
                    $stock->decrement('qte_livre',  $qte);

                    $prod->increment('qte_rest', $qte);
                    $prod->decrement('qte_livre', $qte);
                } else {

                    $CityName = optional($command->city)->name;
                    $this->dispatchBrowserEvent('stock-not-found-city', ['city' => $CityName]);

                    throw ValidationException::withMessages([
                        'stock_not_found' => "Le stock n'existe pas sur la ville $CityName !"
                    ]);
                    exit;
                }
            } else {
            }
        });
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
