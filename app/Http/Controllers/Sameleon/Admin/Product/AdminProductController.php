<?php

namespace App\Http\Controllers\Sameleon\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Product\ProductFormRequest;
use App\Http\Requests\Sameleon\Product\ProductUpdateFormRequest;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{

    public function index()
    {

        if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin')) {
            $products = Product::with('client', 'media')->get();
        } else {
            $products = auth()->user()->products()->with('media')->get();
        }

        return view('Sameleon.Admin.Product.__datatable.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        $clients = User::role('Client')->get();

        return view('Sameleon.Admin.Product.__create.index', compact('clients'));
    }

    public function store(ProductFormRequest $request)
    {

        $this->authorize('create', Product::class);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte_global = $request->qte_global;
        $product->qte_rest = $request->qte_global;

        if (auth()->user()->hasAnyRole('Admin', 'SuperAdmin') && $request->has('client') && $request->filled('client')) {
            $user = User::find($request->client);
            $product->client()->associate($user);
            $product->user_uuid = $user->uuid;
            $product->slug = Str::slug($request->name) . '-' . $user->uuid;
        } else {

            $product->client()->associate(auth()->id());
            $product->user_uuid = auth()->user()->uuid;
            $product->slug = Str::slug($request->name) . '-' . auth()->user()->uuid;
        }

        $product->save();

        if ($request->hasFile('photo')) {

            $product->addMediaFromRequest('photo')->toMediaCollection('products_photos');
        }

        return redirect(route('admin:products.index'))->with('success', "le produit a été ajouté avec succès");
    }

    public function edit(Product $product)
    {

        $this->authorize('update', $product);

        return view('Sameleon.Admin.Product.__edit.index', compact('product'));
    }

    public function update(ProductUpdateFormRequest $request, Product $product)
    {

        $this->authorize('update', $product);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte_global = $request->qte_global;
        $product->qte_rest = $request->qte_global;

        $product->save();

        if ($request->hasFile('photo')) {

            $product->addMediaFromRequest('photo')->toMediaCollection('products_photos');
        }

        return redirect(route('admin:products.index'))->with('success', "L'update a éte effectuer avec succès");
    }

    public function delete(Request $request)
    {

        $request->validate(['productId' => 'required|uuid']);

        $product = Product::whereUuid($request->productId)->firstOrFail();

        $this->authorize('delete', $product);

        if ($product) {

            $product->delete();

            return redirect(route('admin:products.index'))->with('success', "Le produit a éte supprimer avec succès");
        }

        return redirect(route('admin:products.index'))->with('success', "error . . . ");
    }
}
