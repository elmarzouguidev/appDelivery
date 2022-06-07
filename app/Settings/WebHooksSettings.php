<?php

/**
 * Author    : Elmarzougui Abdelghafour (Haymacproduction)
 * website   : https://www.elmarzougui.com
 * linkedin  : https://www.linkedin.com/in/devscript/
 * facebook  : https://www.facebook.com/devscript
 * twitter   : https://twitter.com/devscriptt
 * createdAt : 13/décembre/2020
 **/

namespace App\Settings;

use phpDocumentor\Reflection\Types\Boolean;
use Spatie\LaravelSettings\Settings;

class WebHooksSettings extends Settings
{

    public string $name;

    public ?string $app_platform = 'woocommerce';

    public string $header;

    public string $secret;

    public string $domain;

    public string $route;

    public  bool $validated;

    public  bool $active;

    public static function group(): string
    {
        return 'webhooks';
    }

    /* public static function encrypted(): array
    {
        return [
            'secret'
         ];
    }*/
}
