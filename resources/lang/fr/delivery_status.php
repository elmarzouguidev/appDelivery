<?php
return [

    'statuses' => [
        \App\Status\DeliveryStatus::D_NON_TRAITE => 'Non traité',
        \App\Status\DeliveryStatus::D_ANNULE => 'Annulé',
        \App\Status\DeliveryStatus::D_LIVRE => 'Livré',
        \App\Status\DeliveryStatus::D_CHANGE => 'Change',
        \App\Status\DeliveryStatus::D_ENCOURS => 'En cours',
        \App\Status\DeliveryStatus::D_INJOIGNABLE => 'Injoignable',
        \App\Status\DeliveryStatus::D_INTERESSE => 'Interessé',
        \App\Status\DeliveryStatus::D_NON_INTERESSE => 'Non Interessé',
        \App\Status\DeliveryStatus::D_MANQUE_DE_STOCK => 'Manque De Stock',
        \App\Status\DeliveryStatus::D_PAS_DE_REPONSE => 'Pas de réponse',
        \App\Status\DeliveryStatus::D_RECONFIRMER => 'Reconfirmer',
        \App\Status\DeliveryStatus::D_REFUSE => 'Refusé',
        \App\Status\DeliveryStatus::D_REPORTE => 'Reporté',
        \App\Status\DeliveryStatus::D_RETOURNE => 'Retourné',
    ],

    'classes' => [
        \App\Status\DeliveryStatus::D_NON_TRAITE => 'btn-light',
        \App\Status\DeliveryStatus::D_ANNULE => 'btn-danger',
        \App\Status\DeliveryStatus::D_LIVRE => 'btn-success',
        \App\Status\DeliveryStatus::D_CHANGE => 'btn-info',
        \App\Status\DeliveryStatus::D_ENCOURS => 'btn-info',
        \App\Status\DeliveryStatus::D_INJOIGNABLE => 'btn-danger',
        \App\Status\DeliveryStatus::D_INTERESSE => 'btn-info',
        \App\Status\DeliveryStatus::D_NON_INTERESSE => 'btn-danger',
        \App\Status\DeliveryStatus::D_MANQUE_DE_STOCK => 'btn-danger',
        \App\Status\DeliveryStatus::D_PAS_DE_REPONSE => 'btn-warning',

        \App\Status\DeliveryStatus::D_RECONFIRMER => 'btn-info',
        \App\Status\DeliveryStatus::D_REFUSE => 'btn-danger',
        \App\Status\DeliveryStatus::D_REPORTE => 'btn-dark',
        \App\Status\DeliveryStatus::D_RETOURNE => 'btn-info',
   

    ],

];
