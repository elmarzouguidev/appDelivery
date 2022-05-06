<?php

namespace App\Http\Controllers\Sameleon\Admin\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Region\RegionFormRequest;
use App\Http\Requests\Sameleon\Region\UpdateRegionFormRequest;
use App\Models\Sameleon\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', Region::class);
        
        return view('Sameleon.Admin.Region.__datatable.index');
    }

    public function store(RegionFormRequest $request)
    {
        $this->authorize('create', Region::class);

        $city = Region::create($request->validated());

        if ($city) {
            return redirect()->back()->with('success', 'la région a été crée avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }

    public function update(UpdateRegionFormRequest $request, Region $city)
    {

        $city->name = $request->name;
        $city->frais = $request->frais;
        $city->code = $request->code;
        $city->save();

        return redirect()->back()->with('success', 'la région a été modifier avec success');
    }

    public function delete(Request $request)
    {

        $request->validate(['regionId' => 'required|uuid']);

        $city = Region::whereUuid($request->regionId)->firstOrFail();

        $this->authorize('delete', $city);

        if ($city) {

            $city->delete();

            return redirect()->back()->with('success', 'la région a été supprimer avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }
}
