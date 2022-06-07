<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
 
    protected $except = [

        'appwebhook/*'
        /* this url is renerated from the Hooks Settings exemple : appwebhook/elementor-98c1cd34-4861-438d-ad15-2595f5184e74
        configuration is here : 
        App\Settings\Repositories\WebHooksRepository;*/
    ];
}
