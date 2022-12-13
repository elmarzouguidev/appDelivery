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
        logger($data);
        $fields = $data->billing;
        return $fields;
    }

    protected function getRequest()
    {
        return new HookRequest();
    }
}
