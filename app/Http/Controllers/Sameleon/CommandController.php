<?php

namespace App\Http\Controllers\Sameleon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Command\CommandFormRequest;
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
        $products = auth()->user()->products()->get();

        return view('theme.Sameleon.Command.__create.index', compact('products'));
    }

    public function store(CommandFormRequest $request)
    {

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
                        'price_ht' => $product['quantity'] * $product['prix_unitaire']
                    ],

                );
            }
        }

        return redirect()->back()->with('success', 'la commande a été ajouter avec success');
    }

    public function delete(Request $request)
    {
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
