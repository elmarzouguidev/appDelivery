<?php

namespace App\Http\Controllers\Sameleon\Admin\Command;

use App\Actions\Sameleon\GeneratDayInvoiceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Command\CommandFormRequest;
use App\Http\Requests\Sameleon\Command\CommandUpdateFormRequest;
use App\Http\Requests\Sameleon\Imports\ImportCommandRequest;
use App\Imports\CommandsImport;
use App\Models\Sameleon\Command;
use App\Repositories\City\CityInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminCommandController extends Controller
{
    public function index()
    {

        GeneratDayInvoiceAction::run();

        $cities = app(CityInterface::class)->getCities();

        if (auth()->user()->hasRole('Client')) {

            $commands =  Command::where('user_id', auth()->id())
                ->withSum('products', 'product_command.price_total')
                ->with(['invoice:uuid,id', 'city:id,name'])->get();
        } else {

            $commands = Command::withSum('products', 'product_command.price_total')
                ->with(['invoice:uuid,id', 'city:id,name'])
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        return view('Sameleon.Admin.Command.__datatable.index', compact('cities'));
    }

    public function import(ImportCommandRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new CommandsImport,  $file);

        return redirect()->back()->with('success', 'la list a été importé avec success');
    }

    public function store(CommandFormRequest $request)
    {

        $this->authorize('create', Command::class);

        $command = new Command();

        $command->client_name = $request->client_name;
        $command->client_email = $request->client_email;
        $command->client_phone = $request->client_phone;
        //$command->client_city = $request->client_city;
        $command->client_address = $request->client_address;

        $command->client()->associate(auth()->id());
        $command->city()->associate($request->city);
        $command->frais = $command->city->frais;
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

            //$priceTotal = $command->products()->sum('pivot.price_total');
            // $command->update(['price_total' => $priceTotal]);
        }

        return redirect()->back()->with('success', 'la commande a été ajouter avec success');
    }

    public function edit(Command $command)
    {

        $this->authorize('update', $command);

        $command->load('products');

        $cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.Command.__edit.index', compact('command', 'cities'));
    }

    public function update(CommandUpdateFormRequest $request, Command $command)
    {

        //dd('kkkkkk');
        $this->authorize('update', $command);

        $command->client_name = $request->client_name;
        $command->client_email = $request->client_email;
        $command->client_phone = $request->client_phone;
        $command->client_city = $request->client_city;
        $command->client_address = $request->client_address;
        //$command->client()->associate(auth()->id());
        $command->city()->associate($request->city);
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

        // return redirect($command->edit_url)->with('success', 'la commande a été modifier avec success');
        return redirect()->back()->with('success', 'la commande a été modifier avec success');
    }

    public function delete(Request $request)
    {

        $request->validate(['commandId' => 'required|uuid']);

        $command = Command::whereUuid($request->commandId)->firstOrFail();

        $this->authorize('delete', $command);

        if ($command) {
            // dd('Oui command');
            $command->products()->detach();

            $command->delete();

            return redirect()->back()->with('success', "La command a été supprimer avec success");
        }
        return redirect()->back()->with('success', "Problem ... !!");
    }
}
