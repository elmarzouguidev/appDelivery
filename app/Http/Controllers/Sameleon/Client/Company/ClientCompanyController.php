<?php

namespace App\Http\Controllers\Sameleon\Client\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Company\CompanyFormRequest;
use App\Models\Sameleon\Company;
use App\Repositories\City\CityInterface;
use Illuminate\Http\Request;

class ClientCompanyController extends Controller
{


    public function index()
    {
        $company = auth('client')->user()->company()->first();

        $cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Client.Company.__datatable.index', compact('company', 'cities'));
    }

    public function store(CompanyFormRequest $request)
    {

        $company = Company::whereClientId(auth('client')->id())->first();

        if ($company) {

            //dd('Ouiii');
            $company->name = $request->name;
            $company->website = $request->website;
            $company->logo = $request->logo;
            $company->addresse = $request->addresse;
            $company->telephone = $request->telephone;
            $company->email = $request->email;
            $company->rc = $request->rc;
            $company->ice = $request->ice;
            $company->cnss = $request->cnss;
            $company->patente = $request->patente;
            $company->if = $request->if;

            $company->save();

            return redirect()->back()->with('success', 'les informations a été modifier avec success');
        } else {
           // dd('Noooo');
            $company = new Company();
            $company->name = $request->name;
            $company->website = $request->website;
            $company->logo = $request->logo;
            $company->addresse = $request->addresse;
            $company->telephone = $request->telephone;
            $company->email = $request->email;
            $company->rc = $request->rc;
            $company->ice = $request->ice;
            $company->cnss = $request->cnss;
            $company->patente = $request->patente;
            $company->if = $request->if;

            $company->client()->associate(auth('client')->id());

            $company->save();

            return redirect()->back()->with('success', 'les informations a été ajouter avec success');

        }
    }
}
