<?php

namespace App\Http\Livewire\Sameleon\City;

use App\Models\Sameleon\City as SameleonCity;
use App\Repositories\City\CityInterface;

use Livewire\Component;

class City extends Component
{
    public $cityEdit;

    public $showEdit = false;

    public function render()
    {

        $cities = app(CityInterface::class)->getCities();

        return view('livewire.sameleon.city.city-new', compact('cities'));
    }

    public function editCity(SameleonCity $city)
    {

        $this->showEdit = true;

        $this->cityEdit = $city;

        $this->dispatchBrowserEvent('show-edit');
    }

    public function updateCity()
    {
        
    }
}
