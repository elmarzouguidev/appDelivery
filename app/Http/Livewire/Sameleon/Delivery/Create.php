<?php

namespace App\Http\Livewire\Sameleon\Delivery;

use App\Models\Sameleon\Region;
use App\Repositories\City\CityInterface;
use Livewire\Component;

class Create extends Component
{
    public $regions = [];

    public $city;

    public function render()
    {
        $cities = app(CityInterface::class)->getCities();

        return view('livewire.sameleon.delivery.create', compact('cities'));
    }

    public function mount()
    {
    }

    public function updatedCity()
    {
        $this->regions = Region::where('city_id', $this->city)->select(['id', 'name'])->get();
    }
}
