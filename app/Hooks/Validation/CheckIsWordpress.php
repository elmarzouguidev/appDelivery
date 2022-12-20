<?php

namespace App\Hooks\Validation;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckIsWordpress
{
    private $is_woocommerce = false;

    private $is_elementor = false;

    public function __construct()
    {
    }

    public function check($domainUrl)
    {
        $response = Http::get($domainUrl);

        if (Str::contains($response->body(), ['woocommerce', 'Woocommerce', 'wp-content', 'wp-content/themes', 'wp-content/plugins', 'wp--preset'])) {
            $this->is_woocommerce = true;

            return $this;
        }
        if (Str::contains($response->body(), ['elementor', 'Elementor', 'wp-content', 'wp-content/themes', 'wp-content/plugins', 'wp--preset'])) {
            $this->is_elementor = true;

            return $this;
        }

        return $this;
    }

    public function isWoocommerce()
    {
        return $this->is_woocommerce;
    }

    public function isElementor()
    {
        return $this->is_elementor;
    }
}
