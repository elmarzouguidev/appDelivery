<?php

namespace App\Http\Livewire\Sameleon\Region;

use App\Models\Sameleon\City;
use App\Models\Sameleon\Region as SameleonRegion;
use App\Repositories\City\CityInterface;
use App\Repositories\Region\RegionInterface;
use Livewire\Component;

class Region extends Component
{
    public $regionEdit;

    public $showEdit = false;

    public $city;

    //public int $frais;
    public $total;

    public function render()
    {
        $regions = app(RegionInterface::class)->getRegions();

        $cities = app(CityInterface::class)->getCities();

        return view('livewire.sameleon.region.region-new', compact('regions', 'cities'));
    }

    public function mount()
    {
        $this->city = null;
        //$this->frais = 0;
        $this->total = 0;
    }

    public function updatedCity(int $value)
    {
        if (isset($value) && is_int($value)) {
            $city = City::whereId($this->city)->first();

            $this->total = number_format($city->frais + $city->profit, 2);
        }
    }

    /*public function updatingFrais(int $value)
    {
        if(is_int($value))
        {
            $this->total += $value;
        }
    }*/

    public function editRegion(SameleonRegion $region)
    {
        $this->showEdit = true;

        $this->regionEdit = $region;

        $this->dispatchBrowserEvent('show-edit');
    }
}
