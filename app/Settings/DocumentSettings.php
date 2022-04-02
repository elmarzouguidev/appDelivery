<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class DocumentSettings extends Settings
{
    
    public string $invoice_prefix;
    public int $invoice_start;

    public static function group(): string
    {
        return 'document';
    }
}
