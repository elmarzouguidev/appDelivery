<?php

namespace App\Http\Controllers\Hooks\WooCommerce;

use App\Http\Requests\Hooks\WooCommerce\HookRequest;

trait DataTrait
{

    protected function detachData()
    {
        /**Just for Me  */
        $data = json_decode($this->data, true);
        logger('From Data Trait');
        
        $fields = $data['billing'];
        
        logger('From Data fields');
        logger($fields);
        return $fields;
    }

    protected function getRequest()
    {
        return new HookRequest();
    }
}
