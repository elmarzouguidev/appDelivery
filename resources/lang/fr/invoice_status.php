<?php

use App\Status\InvoiceStatus;

return [

    'statuses' => [
        InvoiceStatus::NON_PAYEE => 'non payé',
        InvoiceStatus::PAYEE => 'payé',
        InvoiceStatus::EN_ATTENT => 'en attente de paiement',
        InvoiceStatus::ANNULER => 'annuler',
        InvoiceStatus::ENCOURS => 'encours',

    ],

    'classes' => [

        InvoiceStatus::NON_PAYEE => 'btn-info',
        InvoiceStatus::PAYEE => 'btn-success',
        InvoiceStatus::EN_ATTENT => 'btn-light',
        InvoiceStatus::ANNULER => 'btn-danger',
        InvoiceStatus::ENCOURS => 'btn-warning',
    ],

];
