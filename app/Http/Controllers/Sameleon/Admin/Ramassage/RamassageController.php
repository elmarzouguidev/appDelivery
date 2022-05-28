<?php

namespace App\Http\Controllers\Sameleon\Admin\Ramassage;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Product;
use Illuminate\Http\Request;

class RamassageController extends Controller
{


    public function index()
    {

        if (auth()->user()->hasRole('Client')) {

            $products = Product::where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->where('is_out', true)
                ->where('qte_rest', 0)
                ->with('media')
                ->get();
        } else {
            $products = Product::with('client:id,nom,prenom')
                ->where('is_out', true)
                ->where('qte_rest', 0)
                ->with('media')
                ->get();
        }

        return view('Sameleon.Admin.Ramassage.index', compact('products'));
    }
}
