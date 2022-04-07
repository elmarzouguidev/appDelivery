<?php


return [

    'cache' => [

        'use-cache' => false,

        'cache-live-time' => 30,

        'clients_cache' => false
    ],

    'api-cache' => [
        'use-cache' => false,

        'cache-live-time' => 30
    ],

    'clients' => [

        'prefix' => 'CLT',
    ],

    'invoices' => [
        'prefix' => 'FACTURE-',
        'start_from' => 800,
        'due_date_after' => 10
    ],

];
