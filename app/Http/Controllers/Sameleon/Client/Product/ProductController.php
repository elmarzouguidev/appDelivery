<?php

namespace App\Http\Controllers\Sameleon\Client\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Product\ProductFormRequest;
use App\Http\Requests\Sameleon\Product\ProductUpdateFormRequest;
use App\Models\Sameleon\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = auth()->user()->products()->get();
        // $products = Product::all();

        return view('theme.Sameleon.Product.__datatable.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.Sameleon.Product.__create.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte_global = $request->qte_global;

        $product->client()->associate(auth()->id());

        $product->save();

        if ($request->hasFile('photo')) {

            $product->addMediaFromRequest('photo')->toMediaCollection('products_photos');
        }

        return redirect(route('sameleon:products.index'))->with('success', "L'ajoute a éte effectuer avec success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('view', $product);

        return view('theme.Sameleon.Product.__edit.index', compact('product'));
    }

    /**
     * 
     */
    public function update(ProductUpdateFormRequest $request, Product $product)
    {

        $this->authorize('update', $product);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qte_global = $request->qte_global;

        $product->save();

        return redirect(route('sameleon:products.index'))->with('success', "L'update a éte effectuer avec success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $request->validate(['productId' => 'required|uuid']);

        $product = Product::whereUuid($request->productId)->firstOrFail();
        
        $this->authorize('delete', $product);

        if ($product) {

            $product->delete();

            return redirect(route('sameleon:products.index'))->with('success', "Le produit a éte supprimer avec success");
        }
        return redirect(route('sameleon:products.index'))->with('success', "error . . . ");
    }
}
