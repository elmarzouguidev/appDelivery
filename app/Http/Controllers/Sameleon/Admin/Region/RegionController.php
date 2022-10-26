<?php

namespace App\Http\Controllers\Sameleon\Admin\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Region\RegionFormRequest;
use App\Http\Requests\Sameleon\Region\UpdateRegionFormRequest;
use App\Models\Sameleon\Region;
use App\Repositories\City\CityInterface;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', Region::class);

        $cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.Region.__datatable.index', compact('cities'));
    }

    public function store(RegionFormRequest $request)
    {
       // dd('yes','##',$request->all());
        $this->authorize('create', Region::class);

        $region = new Region();
        $region->name = $request->name;
        $region->frais = $request->frais;
        $region->description = $request->description;
        $region->city()->associate($request->city);
        $region->save();

        if ($region) {
            
            return redirect()->back()->with('success', 'la région a été crée avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }

    public function update(UpdateRegionFormRequest $request, Region $region)
    {

        $region->name = $request->name;
        $region->frais = $request->frais;
        $region->description = $request->description;
        $region->save();

        return redirect()->back()->with('success', 'la région a été modifier avec success');
    }

    public function delete(Request $request)
    {

        $request->validate(['regionId' => 'required|uuid']);

        $region = Region::whereUuid($request->regionId)->firstOrFail();

        $this->authorize('delete', $region);

        if ($region) {

            $region->commands->each->update(['region_id' => null,'region_uuid' => null]);

            $region->delete();

            return redirect()->back()->with('success', 'la région a été supprimer avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }
}
