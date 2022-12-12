<?php

namespace App\Http\Controllers\Sameleon\Admin\Product;

use App\Exports\Product\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Product\ImportProductFormRequest;
use App\Imports\Product\ProductsImport;
use App\Imports\Product\ProductsImportByAdmins;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class ProductImportController extends Controller
{
    public function import(ImportProductFormRequest $request)
    {
        $this->authorize('import', Product::class);

        $file = $request->file('file');

        if (isAdmin() && $request->has('client') && $request->filled('client')) {
            $client = User::role('Client')->whereUuid($request->client)->first();

            $client ?? throw ValidationException::withMessages([

                'client_not_found' => "Le client ( {$client->full_name} ) n'existe pas dans le systeme !"

            ]);

            Excel::import(new ProductsImportByAdmins($client),  $file);
        } else {

            Excel::import(new ProductsImport,  $file);
        }

        return redirect()->back()->with('success', "la list a été importé avec success  n'oublie pas d'ajouter leurs images !");
    }

    public function exportFile()
    {
        
        if (client()) {
            return (new ProductsExport)->forUser(client())->download(now() . 'products.xlsx');
        }
        return (new ProductsExport)->download(now() . 'products.xlsx');
    }
}
