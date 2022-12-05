<?php

namespace App\Http\Controllers\Sameleon\API\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\Sameleon\API\CommandRequest;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Item;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Region;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ApiCommandController extends Controller
{
    public function index()
    {
    }

    public function track(string $code)
    {
    }

    public function store(CommandRequest $request)
    {

        $citySlug = Str::slug(str_replace(' ', '', $request->ville));

        $regionSlug = Str::slug(str_replace(' ', '', $request->region));

        $ville = City::whereSlug($citySlug)->first();

        $region = Region::whereSlug($regionSlug)->first() ?? null;

        if (!$ville) {

            return response()->json(
                [
                    '_response' => ['msg' => "désole cette ville ($request->ville) n'existe pas dans notre systeme veuillez vérifier le nom de la ville !!"]
                ],
                404
            );
            exit();
        }

        if ($request->has('region') && $request->filled('region') && !$region) {

            return response()->json(
                [
                    '_response' => ['msg' => "désole cette région ($request->region) n'existe pas dans notre systeme veuillez vérifier le nom de la région !!"]
                ],
                404
            );
            exit();
        }

        if ($request->has('region') && $request->filled('region') && $region && !$region->city()->is($ville)) {

            return response()->json(
                [
                    '_response' => ['msg' => "désole cette région ($request->region) ne correspond pas a la ville ($ville->name) !!"]
                ],
                404
            );
            exit();
        }

        if ($request->has('public_key') && $request->has('secret_key') && $request->filled('secret_key') && $request->filled('public_key')) {
            $user = User::where('public_key_api', $request->public_key)
                ->where('secret_key_api', $request->secret_key)
                ->first();
            if (!$user) {

                return response()->json(
                    [
                        '_response' => ['msg' => "désole cette clé n'existe pas dans notre systeme veuillez vérifier votre public_key est secret_key !!"]
                    ],
                    404
                );
                exit();
            }
            if ($user && $user->hasRole('Client') && !$user->hasPermissionTo('api.create')) {

                return response()->json(
                    [
                        '_response' => ['msg' => "vous n'avez pas les droits pour créer une commande via API veuillez contacter l'administrateur pour vous donner les droits d'API"]
                    ],
                    404
                );
                exit();
            }
            if ($user && $user->hasRole('Client') && $user->hasPermissionTo('api.create')) {


                if ($request->has('items') && $request->filled('items')) {

                    $totalFrais = $ville->frais;

                    if ($region) {
                        $totalFrais += $region->frais;
                    }

                    $command  =  Command::create([
                        'client_name'     => $request->destinataire,
                        'client_phone'    => $request->telephone,
                        'client_city'    => $request->ville,
                        'client_address'    => $request->adresse,
                        'city_id' => $ville ? $ville->id : null,
                        'city_uuid' => $ville ? $ville->uuid : null,
                        'region_id' => $region ? $region->id : null,
                        'region_uuid' => $region ? $region->uuid : null,
                        'user_id' => $user->id,
                        'user_uuid' => $user->uuid,
                        'is_api' => true,
                        'frais' => $totalFrais
                    ]);

                    foreach ($request->items as $item) {

                        $productSlug = Str::slug(str_replace(' ', '', $item['name'])) . '-' . $user->uuid . ':' . $user->id;

                        $product = Product::whereUserId($user->id)
                            ->whereUserUuid($user->uuid)
                            ->whereSlug($productSlug)->first();

                        if ($product) {

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
                        } else {

                            $command->delete();

                            return response()->json(
                                [
                                    '_response' => ['msg' => "désole le produit ( {$item['name']} ) n'existe pas dans notre systeme"]
                                ],
                                404
                            );

                            exit();
                        }
                    }
                }

                return response()->json(
                    [

                        '_response' => ['msg' => 'votre commande est crée avec succès'],
                        'code' => 200
                    ],
                    200
                );
            }
        } else {

            return response()->json(
                [

                    '_response' => ['msg' => 'erreur veuillez vérifier la structure de votre API']
                ],
                402
            );
        }
    }
}
