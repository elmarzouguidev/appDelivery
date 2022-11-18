<?php

namespace App\Http\Livewire\Sameleon\Command\SubDelivery;

use App\Filters\ItemsQuery;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Delivery;
use App\Models\Sameleon\Product;
use App\Status\DeliveryStatus;
use App\Status\Status;
use Livewire\Component;

use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use PhpParser\Node\Stmt\Else_;

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

        $commandStatus = implode(',', [
            Status::NON_TRAITE, Status::EXPEDIE, Status::ENCOURS, Status::REPORTE,
            Status::REFUSE, Status::RETOURNE,
            Status::PAS_DE_REPONSE, Status::INJOIGNABLE, Status::ANNULE, Status::LIVRE
        ]);

        $commandDeliveryStatus = implode(',', [
            Status::ENCOURS, Status::REPORTE, Status::REFUSE, Status::RETOURNE,
            Status::PAS_DE_REPONSE, Status::INJOIGNABLE, Status::ANNULE, Status::LIVRE
        ]);

        if (isDelivery() && delivery()->hasRole('DeliveryEntreprise')) {

            $commands =  $command
                ->where('delivery_id', delivery()->id)
                ->where('delivery_uuid', delivery()->uuid)
                ->where('city_id', delivery()->city->id)
                ->where('city_uuid', delivery()->city->uuid)
                //->whereIn('status', [Status::EXPEDIE, Status::LIVRE])
                //->where('updated_at', now())
                ->with('items')
                ->withSum('items', 'prix_total')
                //->with('products.stock')
                ->with(['city:id,name'])
                ->orderByRaw("FIELD(status, $commandStatus)")
                ->orderByRaw("created_at DESC")
                ->paginate(60);

            $delivries = Delivery::role('SubDelivery')->where([
                'parent_id' => delivery()->id,
                'parent_uuid' => delivery()->uuid
            ])->get();
            // dd($commandStatus);
            return view('livewire.sameleon.command.sub-delivery.commands', compact('commands', 'delivries'));
        } elseif (isDelivery() && delivery()->hasRole('SubDelivery')) {
    
            $commands =  $command
                ->where('sub_delivery_id', delivery()->id)
                ->where('sub_delivery_uuid', delivery()->uuid)
                ->where('delivery_id', delivery()->parent_id)
                ->where('delivery_uuid', delivery()->parent_uuid)
                ->where('city_id', delivery()->city->id)
                ->where('city_uuid', delivery()->city->uuid)
                ->with('items')
                ->withSum('items', 'prix_total')
                ->with(['city:id,name'])
                ->orderByRaw("FIELD(status, $commandStatus)")
                //->orderByRaw("created_at DESC")
                ->paginate(60);

            return view('livewire.sameleon.command.sub-delivery.command-subdelivery', compact('commands'));
        }
    }

    public function mount()
    {

        $this->emit('refresh');

        $this->showEdit = false;

        $this->reportTime = now()->format('d-m-Y');

        $this->reportComment = '';
    }

    public function attachToSubDelivery()
    {
        if (count($this->selectedCommands) && is_string($this->selectedDelivery)); {

            $delivery = Delivery::whereUuid($this->selectedDelivery)
                ->whereParentId(delivery()->id)
                ->whereParentUuid(delivery()->uuid)
                ->first();

            $status = Status::ENCOURS;

            if ($delivery) {

                Command::find($this->selectedCommands)->each->update([

                    'sub_delivery_id' => $delivery->id,
                    'sub_delivery_uuid' => $delivery->uuid,
                    'status' => $status,
                    'delivery_status' => DeliveryStatus::D_ENCOURS

                ]);

                $this->dispatchBrowserEvent('notify-global', ['message' => 'les commands envoyer avec succès']);

                $this->dispatchBrowserEvent('status-updated');
            } else {
                $this->dispatchBrowserEvent('notify-global', ['message' => "le Livreur n'exist pas dans le system !"]);

                $this->dispatchBrowserEvent('status-updated');
            }
        }
    }


    public function editStatus(Command $command)
    {

        $this->showEditStatus = true;

        $this->commandEdit = $command;

        $this->dispatchBrowserEvent('show-edit-status');
    }
    public function changeStatus(Command $command, int $status)
    {

        $items = $command->items;

        if ($status == Status::LIVRE && $command->status != Status::LIVRE) {

            $items->each(function ($item, $key) use ($command, $status) {

                $prod = Product::find($item->product_id);

                if ($prod) {

                    $qte = (int)$item->quantity;

                    $stock = $prod->stocks()->where([
                        'city_id' => $command->city_id,
                        'city_uuid' => $command->city_uuid,
                        'is_out' => false
                    ])->first();

                    if ($stock) {
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
                        $CityName = optional($command->city)->name;

                        $this->dispatchBrowserEvent('stock-not-found-city', ['city' => $CityName, 'product' => $prod->name]);

                        throw ValidationException::withMessages([
                            'stock_not_found' => "Manque de stock ($prod->name)"
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
                        'is_out' => false
                    ])->first();

                    if ($stock) {
                        if ($stock->qte_rest !== 0 && $stock->qte_rest > 0 || $stock->qte_rest >= $qte) {

                            $stock->increment('qte_rest', $qte);
                            $stock->decrement('qte_livre',  $qte);
                        }

                        if ($stock->qte_rest == 0) {

                            $stock->update(['is_out' => true]);

                            $command->update(['status' => Status::MANQUE_DE_STOCK]);
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
                    $CityName = optional($command->city)->name;

                    $this->dispatchBrowserEvent('product-not-found', ['product' => $item->product]);

                    throw ValidationException::withMessages([
                        'stock_not_found' => "Le produit ($item->product) n'existe pas sur le systeme !"
                    ]);
                    exit;
                }
            });
        } else {

            $command->update(['status' => $status]);
        }

        $this->isRepoted = true;

        if ($this->commandEdit->reported_at != null) {

            $this->reportTime = $this->commandEdit->reported_at->format('d-m-Y');
        }

        $this->reportComment =  str_replace('<br />', '', $this->commandEdit->comment);

        $this->dispatchBrowserEvent('status-reported');
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
