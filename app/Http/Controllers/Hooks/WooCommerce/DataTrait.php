<?php

namespace App\Http\Controllers\Hooks\WooCommerce;

use App\Http\Requests\Hooks\WooCommerce\HookRequest;

trait DataTrait
{

    protected function detachData()
    {
        $data = json_decode($this->data, true);
        $fields = $data['payload']['billing'];
        return $fields;
    }

    protected function getRequest()
    {
        return new HookRequest();
    }
}
