<?php

namespace App\Http\Controllers\Hooks\WooCommerce;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Hooks\WooCommerce\HookRequest;
use App\Models\Sameleon\City;
use App\Models\Sameleon\Command;
use App\Models\Sameleon\Item;
use App\Models\Sameleon\Product;
use App\Models\Sameleon\Tag;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;

class WooCommerceController extends Controller
{

    private $data;

    private $client;

    public function __construct(Request $request)
    {

        $user =  substr($request->route()->uri(), strpos($request->route()->uri(), "@") + 1);

        logger($request->header());

        $this->data = $request;

        $this->getClient($user);

        $this->setData();
    }

    private function getClient($user)
    {
        $this->client = User::whereUuid($user)->first();
    }

    public function setData()
    {
        $fields = $this->data->all();

        $validateData = $this->getRequest();

        $validator = Validator::make($fields, $validateData->rules());

        if ($validator->fails()) {

            Log::error($validator->errors());
        }

        $items =  $validator->validated();
        
        $this->addCommand($items);
    }

    private function addCommand($items)
    {
        $city = City::whereName($items['billing']['city'])->first();

        $command = Command::create([
            'client_name'     => $items['billing']['first_name'] . ' ' . $items['billing']['last_name'],
            'client_phone'    => $items['billing']['phone'],
            'client_city'    => $items['billing']['city'],
            'client_address'    => $items['billing']['address_1'],
            'city_id' => $city ? $city->id : null,
            'city_uuid' => $city ? $city->uuid : null,
            //'region_id' => $region ? $region->id : null,
            //'region_uuid' => $region ? $region->uuid : null,
            'user_id' => $this->client->id,
            'user_uuid' => $this->client->uuid,
            'frais' => $city ? $city->frais : 00
        ]);
        collect($items['line_items'])->each(function ($item) use ($command) {

            $product = Product::whereName($item['name'])->first();

            Item::create([
                'command_id' => $command->id,
                'command_uuid' => $command->uuid,
                'product_id' => $product ?  $product->id : null,
                'product_uuid' => $product ? $product->uuid : null,
                'designation' => $item['name'],
                'product' => $item['name'],
                'quantity' => $item['quantity'],
                'prix_uni' => round($item['total'] / $item['quantity']),
                'prix_total' => $item['total'],
            ]);
        });

        $tag = Tag::whereName('woocommerce')->first();

        $command->tags()->attach($tag);

    }
    protected function detachData()
    {
        /**Just for Me  */
        $data = $this->data;
        $clientInfos = $data['billing'];
        $products = $data['line_items'];
        $datas = array_merge($clientInfos, $products);
        return $datas;
    }

    protected function getRequest()
    {
        return new HookRequest();
    }
}
