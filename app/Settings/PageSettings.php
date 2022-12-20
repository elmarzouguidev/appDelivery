<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PageSettings extends Settings
{
    public string $product_condition;

    public static function group(): string
    {
        return 'page';
    }
}
