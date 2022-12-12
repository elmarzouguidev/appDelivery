<?php

namespace App\Http\Controllers\Hooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HooksController extends Controller
{


    public function index()
    {
        return "hello from sameleon Hooks System";
    }

    public function woocommerce()
    {
        logger('woocommerce had ben invoked hahah');
    }

    public function elementor()
    {
        logger('ELEMENTOR had ben invoked hahah');
    }

    public function shopify()
    {
        logger('shopify had ben invoked hahah');
    }
}
