<?php

return [

    'platform' => env('WEBHOOK_PLATFORM', 'woocommerce'),

    'header_signature'=> env('WEBHOOK_HEADER_SIGNATURE', 'x-wc-webhook-signature'),
];