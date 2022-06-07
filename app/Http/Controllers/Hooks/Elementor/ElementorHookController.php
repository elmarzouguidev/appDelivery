<?php

namespace App\Http\Controllers\Hooks\Elementor;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ElementorHookController extends Controller
{

    use DataTrait;

    private $data;

    public function __construct($data)
    {
      //  $this->middleware('auth');
        $this->data = $data;
        $this->setData();
    }


    public function setData()
    {
        $fields = $this->detachData();
        Log::info($fields);
        $validateData = $this->getRequest();

        $validator = Validator::make($fields, $validateData->rules());

        if ($validator->fails()) {

            Log::error($validator->errors());
        }

        $items =  $validator->validated();

       //  Log::info($items);
        // Log::info('From ClickFunnelsHookController');
        // Logger($data);

        //  http_response_code(200);

    }

    protected function saveData()
    {
    }


}
