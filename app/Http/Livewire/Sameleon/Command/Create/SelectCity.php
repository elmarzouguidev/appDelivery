<?php

namespace App\Http\Livewire\Sameleon\Command\Create;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Region;
use App\Repositories\City\CityInterface;
use Livewire\Component;

class SelectCity extends Component
{
    public Command $command;

    public $city;

    public $region;

    public $cities;

    public $regions;

    public function render()
    {
        return view('livewire.sameleon.command.create.select-city');
    }

    public function mount()
    {
        $this->cities = app(CityInterface::class)->getCities();

        $this->regions = [];
    }

    public function updatedCity($value)
    {
        $this->regions = Region::whereCityId($value)->get();
    }
}
