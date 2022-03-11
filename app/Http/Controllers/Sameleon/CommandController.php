<?php

namespace App\Http\Controllers\Sameleon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Command\CommandFormRequest;
use App\Http\Requests\Sameleon\Command\CommandUpdateFormRequest;
use App\Models\Sameleon\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{


    public function index()
    {
        $orders = auth()->user()->commands()->with('products')->get();

        $products = auth()->user()->products()->get();

        return view('theme.Sameleon.Command.index', compact('orders', 'products'));
    }

    public function create()
    {

        if (auth()->user()->products->count() <= 0) {

            return redirect(route('sameleon:products.create'))->with('notice', 'entrer un produit avant ajouter une command');
        }

        $this->authorize('create', Command::class);

        $products = auth()->user()->products()->get();

        return view('theme.Sameleon.Command.__create.index', compact('products'));
    }

    public function store(CommandFormRequest $request)
    {

        $this->authorize('create', Command::class);

        $command = new Command();

        $command->client_name = $request->client_name;
        $command->client_email = $request->client_email;
        $command->client_phone = $request->client_phone;
        $command->client_city = $request->client_city;
        $command->client_address = $request->client_address;

        $command->client()->associate(auth()->id());
        $command->save();

        if ($command) {

            foreach ($request->orderProducts as $product) {
                $command->products()->attach(
                    (int)$product['product_id'],
                    [
                        'quantity' => $product['quantity'],
                        'price_ht' => $product['prix_unitaire'],
                        'price_total' => $product['quantity'] * $product['prix_unitaire'],
                        'designation' => $product['designation']
                    ],

                );
            }
        }

        return redirect()->back()->with('success', 'la commande a été ajouter avec success');
    }

    public function edit(Command $command)
    {

        $this->authorize('update', $command);

        $command->load('products');

        return view('theme.Sameleon.Command.__edit.index', compact('command'));
    }

    public function update(CommandUpdateFormRequest $request, Command $command)
    {

        $this->authorize('update', $command);

        $command->client_name = $request->client_name;
        $command->client_email = $request->client_email;
        $command->client_phone = $request->client_phone;
        $command->client_city = $request->client_city;
        $command->client_address = $request->client_address;
        //$command->client()->associate(auth()->id());
        $command->save();

        if ($command) {
            if (count($request->getOldArticles())) {
                foreach ($request->orderProducts as $product) {

                    $command->products()->updateExistingPivot(
                        (int)$product['product_id'],
                        [
                            'quantity' => $product['quantity'],
                            'price_ht' => $product['prix_unitaire'],
                            'price_total' => $product['quantity'] * $product['prix_unitaire'],
                            'designation' => $product['designation']
                        ],

                    );
                }
            }

            if (count($request->getNewArticles())) {

                foreach ($request->newOrderProducts as $product) {

                    $command->products()->attach(
                        (int)$product['product_id'],
                        [
                            'quantity' => $product['quantity'],
                            'price_ht' => $product['prix_unitaire'],
                            'price_total' => $product['quantity'] * $product['prix_unitaire'],
                            'designation' => $product['designation']
                        ],

                    );
                }
            }
        }

        return redirect($command->edit_url)->with('success', 'la commande a été modifier avec success');
    }

    public function delete(Request $request)
    {
        $this->authorize('delete', $command);

        $request->validate(['commandId' => 'required|uuid']);

        $command = Command::whereUuid($request->commandId)->firstOrFail();

        if ($command && $command->client()->is(auth()->user())) {
            // dd('Oui command');
            $command->products()->detach();

            $command->delete();

            return redirect()->back()->with('success', "La command a été supprimer avec success");
        }
        return redirect()->back()->with('success', "Problem ... !!");
    }
}
