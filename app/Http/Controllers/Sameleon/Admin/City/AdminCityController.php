<?php

namespace App\Http\Controllers\Sameleon\Admin\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\City\CityFormRequest;
use App\Http\Requests\Sameleon\City\CityUpdateFormRequest;
use App\Models\Sameleon\City;
use App\Repositories\City\CityInterface;
use Illuminate\Http\Request;

class AdminCityController extends Controller
{
    public function index()
    {

        $this->authorize('viewAny', City::class);

        //$cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.City.__datatable.index');
    }

    public function store(CityFormRequest $request)
    {
        $this->authorize('create', City::class);

        $city = City::create($request->validated());

        if ($city) {
            return redirect()->back()->with('success', 'la ville a été crée avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }

    public function update(CityUpdateFormRequest $request, City $city)
    {

        $city->name = $request->name;
        $city->frais = $request->frais;
        $city->code = $request->code;
        $city->save();

        return redirect()->back()->with('success', 'la ville a été modifier avec success');
    }

    public function delete(Request $request)
    {

        

        $request->validate(['cityId' => 'required|uuid']);

        $city = City::whereUuid($request->cityId)->firstOrFail();

        $this->authorize('delete', $city);

        if ($city) {

            $city->delete();

            return redirect()->back()->with('success', 'la ville a été supprimer avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }
}
