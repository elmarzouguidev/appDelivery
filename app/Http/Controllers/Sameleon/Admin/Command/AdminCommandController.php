<?php

namespace App\Http\Controllers\Sameleon\Admin\Command;

use App\Actions\Sameleon\InvoiceGenerator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Command\CommandFormRequest;
use App\Http\Requests\Sameleon\Command\CommandUpdateFormRequest;
use App\Http\Requests\Sameleon\Imports\ImportCommandRequest;
use App\Imports\CommandsImport;
use App\Imports\CommandsImportByAdmins;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use App\Repositories\City\CityInterface;
use App\Repositories\Client\ClientInterface;
use App\Repositories\Command\CommandInterface;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class AdminCommandController extends Controller
{
    public function index()
    {


        InvoiceGenerator::run();

        $cities = app(CityInterface::class)->getCities();

        $clients = [];

        if (isAdmin()) {
            $clients = app(ClientInterface::class)->getClients();
        }

        //$commands = Command::withSum('products', 'product_command.price_total')->get();
        //$commands = Command::with('products')->get();

        return view('Sameleon.Admin.Command.__datatable.index', compact('cities', 'clients'));
    }

    public function import(ImportCommandRequest $request)
    {
        $this->authorize('import', Command::class);

        $file = $request->file('file');

        if (isAdmin() && $request->has('client') && $request->filled('client')) {
            $client = User::role('Client')->whereUuid($request->client)->first();

            $client ?? throw ValidationException::withMessages([

                'client_not_found' => "Le client ( {$client->full_name} ) n'existe pas dans le systeme !"

            ]);

            Excel::import(new CommandsImportByAdmins($client),  $file);
        } else {

            Excel::import(new CommandsImport,  $file);
        }

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
        $command->user_uuid = auth()->user()->uuid;

        $command->city()->associate($request->city);
        $command->city_uuid = $command->city?->uuid;

        $request->whenFilled('region', function ($region) use ($command) {
            $command->region()->associate($region);
            $command->region_uuid = $command->region?->uuid;
        });

        $command->frais = $command->city?->frais + $command->region?->frais ?? 0;

        $command->save();

        if ($command) {

            /*foreach ($request->orderProducts as $product) {
                $command->products()->attach(
                    (int)$product['product_id'],
                    [
                        'command_uuid' => $command->uuid,
                        'quantity' => $product['quantity'],
                        'price_ht' => $product['prix_unitaire'],
                        'price_total' => $product['quantity'] * $product['prix_unitaire'],
                        'designation' => $product['designation'],

                    ],

                );
            }*/

            foreach ($request->orderProducts as $product) {

                $prod = Product::find($product['product_id']);

                $command->items()->create([
                    'command_uuid' => $command->uuid,
                    'product_id' => $product['product_id'],
                    'product_uuid' => $prod->uuid,
                    'designation' => $product['designation'],
                    'product' => $prod->name,
                    'quantity' => $product['quantity'],
                    'prix_uni' => $product['prix_unitaire'],
                    'prix_total' => $product['quantity'] * $product['prix_unitaire'],
                ]);
            }

            //$priceTotal = $command->products()->sum('pivot.price_total');
            // $command->update(['price_total' => $priceTotal]);
        }

        $command->histories()->create([
            'user_id' => auth()->id(),
            'user_uuid' => auth()->user()->uuid,
            'description' => "a crée la command <strong>$command->code</strong>",
            'action' => 'create'
        ]);

        return redirect()->back()->with('success', 'la commande a été ajouter avec success');
    }

    public function edit(Command $command)
    {

        $this->authorize('update', $command);

        $command->load('items')->loadSum('items', 'prix_total');;

        //$cities = app(CityInterface::class)->getCities();

        return view('Sameleon.Admin.Command.__edit.index', compact('command'));
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

        $command->city()->associate($request->city);
        $command->city_uuid = $command->city?->uuid;

        $request->whenFilled('region', function ($region) use ($command) {
            $command->region()->associate($region);
            $command->region_uuid = $command->region?->uuid;
        });

        $command->frais = $command->city?->frais + $command->region?->frais ?? 0;

        $command->save();

        if ($command) {
            /*if (count($request->getOldArticles())) {

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
            }*/

            if (count($request->getNewArticles())) {

                foreach ($request->newOrderProducts as $product) {

                    $prod = Product::find($product['product_id']);

                    $command->items()->create([
                        'command_uuid' => $command->uuid,
                        'product_id' => $product['product_id'],
                        'product_uuid' => $prod->uuid,
                        'designation' => $product['designation'],
                        'product' => $prod->name,
                        'quantity' => $product['quantity'],
                        'prix_uni' => $product['prix_unitaire'],
                        'prix_total' => $product['quantity'] * $product['prix_unitaire'],
                    ]);
                }
            }
        }

        $command->histories()->create([

            'user_id' => auth()->id(),
            'user_uuid' => auth()->user()->uuid,
            'description' => "a modifier la command <strong>$command->code</strong>",
            'action' => 'update'
        ]);
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
            $command->tags()->detach();

            $command->items()->delete();

            $command->histories()->delete();

            $command->delete();

            return redirect()->back()->with('success', "La command a été supprimer avec success");
        }
        return redirect()->back()->with('success', "Problem ... !!");
    }

    public function archived()
    {
        $commands = app(CommandInterface::class)->getArchivedCommands();

        return view('Sameleon.Admin.Command.Archive.index', compact('commands'));
    }


    public function downloadExemple()
    {
        return redirect()->url('https://sameleon-express.ma/sameleon-express-excel-commands.xlsx');
    }
}
