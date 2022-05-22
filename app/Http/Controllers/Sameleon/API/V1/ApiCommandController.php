<?php

namespace App\Http\Controllers\Sameleon\API\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\Sameleon\API\CommandRequest;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Item;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiCommandController extends Controller
{
    public function index()
    {
    }

    public function single()
    {
    }

    public function store(CommandRequest $request)
    {

        $ville = City::whereName($request->ville)->first();

        if ($request->has('public_key') && $request->has('secret_key') && $request->filled('secret_key') && $request->filled('public_key')) {
            $user = User::where('public_key_api', $request->public_key)
                ->where('secret_key_api', $request->secret_key)
                ->first();
            if (!$user) {
                return response()->json(
                    [

                        '_response' => ['msg' => "désole cette clé n'exists pas"]
                    ],
                    404
                );
                exit();
            }

            if ($user && $user->hasRole('Client')) {

                $command  =  Command::create([
                    'client_name'     => $request->destinataire,
                    'client_phone'    => $request->telephone,
                    'client_city'    => $request->ville,
                    'client_address'    => $request->adresse,
                    'city_id' => $ville ? $ville->id : null,
                    'user_id' => $user->id,
                    'user_uuid' => $user->uuid,
                    'is_api' => true
                ]);

                if ($command) {

                    foreach ($request->items as $index => $item) {

                        $slug = Str::slug(str_replace(' ', '', $item['name'])) . '-' . $user->uuid;

                        $product = Product::whereUserId($user->id)->whereSlug($slug)->first();
                        // dd($product,$slug);
                        Item::create([
                            'command_id' => $command->id,
                            'command_uuid' => $command->uuid,
                            'product_id' => $product ?  $product->id : null,
                            'product_uuid' => $product ? $product->uuid : null,
                            'designation' => $item['name'],
                            'product' => $item['name'],
                            'quantity' => $item['quantity'],
                            'prix_uni' => round($item['prix_total'] / $item['quantity']),
                            'prix_total' => $item['prix_total'],
                        ]);
                    }
                }
                return response()->json(
                    [

                        '_response' => ['msg' => 'votre commande est crée avec succès']
                    ],
                    200
                );
            }
        } else {

            return response()->json(
                [

                    '_response' => ['msg' => 'error']
                ],
                402
            );
        }
    }
}
