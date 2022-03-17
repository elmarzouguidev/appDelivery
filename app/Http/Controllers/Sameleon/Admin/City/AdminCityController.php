<?php

namespace App\Http\Controllers\Sameleon\Admin\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\City\CityFormRequest;
use App\Models\Sameleon\City;
use App\Repositories\City\CityInterface;
use Illuminate\Http\Request;

class AdminCityController extends Controller
{
    public function index()
    {

        $cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.City.__datatable.index', compact('cities'));
    }

    public function store(CityFormRequest $request)
    {
        $city = City::create($request->validated());

        if ($city) {
            return redirect()->back()->with('success', 'la ville a été crée avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }

    public function delete(Request $request)
    {
      
        $request->validate(['cityId' => 'required|uuid']);

        $city = City::whereUuid($request->cityId)->firstOrFail();

        if ($city) {

            //$city->delete();

            return redirect()->back()->with('success', 'la ville a été supprimer avec success');
        }

        return redirect()->back()->with('error', 'error ...');
    }
}
