<?php

namespace App\Http\Controllers\Sameleon\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Product\ProductFormRequest;
use App\Http\Requests\Sameleon\Product\ProductUpdateFormRequest;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use App\Notifications\ProductCreated;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Stock\StockInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Notification;
class AdminProductController extends Controller
{

    public function index()
    {
        /*if (request()->has('appFilter') && request()->filled('appFilter')) {

            cache()->forget('all_products_cache');

            $products = QueryBuilder::for(app(ProductInterface::class)->__instance())
                ->allowedFilters([
                    AllowedFilter::scope('GetClient', 'filter_client'),
                    AllowedFilter::scope('GetStock', 'filter_stock'),
                    AllowedFilter::scope('GetDate', 'filter_dated')

                ])
                ->with(['media', 'client:id,nom,prenom', 'stockMutations'])
                ->paginate(40)
                ->appends(request()->query());
                cache()->forget('all_products_cache');
        } else {

           

        }*/

        $products = app(ProductInterface::class)->getProducts();

        $clients = app(ClientInterface::class)->getClients();

        return view('Sameleon.Admin.Product.__normal_table.index', compact('products', 'clients'));
    }
    public function deliveryEntreprise()
    {

        $products = app(StockInterface::class)->getStocks();

        return view('Sameleon.Admin.Product.__normal_table.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);

        $clients = app(ClientInterface::class)->getClients();

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
            $product->slug = Str::slug(str_replace(' ', '', $request->name)) . '-' . $user->uuid;
        } else {

            $product->client()->associate(auth()->id());
            $product->user_uuid = auth()->user()->uuid;
            $product->slug = Str::slug(str_replace(' ', '', $request->name)) . '-' . auth()->user()->uuid;
        }


        $product->save();

        $product->increaseStock($request->qte_global);

        if ($request->hasFile('photo')) {

            $product->addMediaFromRequest('photo')->toMediaCollection('products_photos');
        }

        $delay = now()->addMinutes(10);
 
        //$user->notify((new ProductCreated($product))->delay($delay));

        $users = User::role('SuperAdmin')->get();

        Notification::send($users, new ProductCreated($product));

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
