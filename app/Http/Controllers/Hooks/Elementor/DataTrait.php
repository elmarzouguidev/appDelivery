<?php

namespace App\Http\Controllers\Hooks\Elementor;

use App\Http\Requests\Hooks\Elementor\HookRequest;

trait DataTrait {


    protected function detachData()
    {

        $data = json_decode($this->data, true);

       // logger($data);
        $raw_fields = $data['payload']['fields'];

        $fields = [];
        
        foreach ($raw_fields as $id => $field) {
            $fields[$id] = $field['value'];
        }
        return $fields;
    }

    
    protected function getRequest()
    {
        return new HookRequest();
    }

    
}