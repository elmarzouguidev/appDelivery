<?php

namespace App\Http\Controllers\Hooks\ClickFunnels;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hooks\ClickFunnels\HookRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClickFunnelsHookController extends Controller
{
    //

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->setData();
    }

    public function getRequest()
    {

        return new HookRequest();
    }

    public function setData()
    {
        $data = json_decode($this->data, true);
        $validateData = $this->getRequest();
        $validator = Validator::make($data['payload'], $validateData->rules());

        if ($validator->fails()) {
            Log::error($validator->errors());
        }

        $items =  $validator->validated();
        Log::info($items);
        // Log::info('From ClickFunnelsHookController');
        // Logger($data);

        //  http_response_code(200);

    }
}
