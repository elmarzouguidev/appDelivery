<?php

namespace App\Http\Controllers\Hooks\Shopify;

use App\Http\Requests\Hooks\Shopify\HookRequest;

trait DataTrait
{

    protected function detachData()
    {
        $data = json_decode($this->data, true);
        return $data;
    }

    protected function getRequest()
    {
        return new HookRequest();
    }
}
