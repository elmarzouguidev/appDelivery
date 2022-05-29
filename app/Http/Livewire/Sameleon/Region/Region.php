<?php

namespace App\Http\Livewire\Sameleon\Region;

use App\Models\Sameleon\Region as SameleonRegion;
use App\Repositories\Region\RegionInterface;
use Livewire\Component;

class Region extends Component
{

    public $regionEdit;

    public $showEdit = false;

    public function render()
    {
        $regions = app(RegionInterface::class)->getRegions();

        return view('livewire.sameleon.region.region-new', compact('regions'));
    }

    public function editRegion(SameleonRegion $region)
    {

        $this->showEdit = true;

        $this->regionEdit = $region;

        $this->dispatchBrowserEvent('show-edit');
    }

    public function updateRegion()
    {
    }
}
