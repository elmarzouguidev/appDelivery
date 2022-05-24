<?php
return [

    'statuses' => [
        \App\Status\Status::NON_TRAITE => 'Non traité',
        \App\Status\Status::ANNULE => 'Annulé',
        \App\Status\Status::LIVRE => 'Livré',
        \App\Status\Status::CHANGE => 'Change',
        \App\Status\Status::ENCOURS => 'En cours',
        \App\Status\Status::EXPEDIE => 'Expédié',
        \App\Status\Status::INJOIGNABLE => 'Injoignable',
        \App\Status\Status::INTERESSE => 'Interessé',
        \App\Status\Status::NON_INTERESSE => 'Non Interessé',
        \App\Status\Status::MANQUE_DE_STOCK => 'Manque De Stock',
        \App\Status\Status::PAS_DE_REPONSE => 'Pas de réponse',
        \App\Status\Status::PAS_DE_REPONSE_2 => 'Pas de réponse 2 fois',
        \App\Status\Status::PAS_DE_REPONSE_3 => 'Pas de réponse 3 fois',
        \App\Status\Status::PAS_DE_REPONSE_4 => 'Pas de réponse 4 fois',
        \App\Status\Status::PAS_DE_REPONSE_5 => 'Pas de réponse 5 fois',
        \App\Status\Status::RECONFIRMER => 'Reconfirmer',
        \App\Status\Status::REFUSE => 'Refusé',
        \App\Status\Status::REPORTE => 'Reporté',
        \App\Status\Status::RETOURNE => 'Retourné',

    ],

    'classes' => [
        \App\Status\Status::NON_TRAITE => 'btn-light',
        \App\Status\Status::ANNULE => 'btn-danger',
        \App\Status\Status::LIVRE => 'btn-success',
        \App\Status\Status::CHANGE => 'btn-info',
        \App\Status\Status::ENCOURS => 'btn-info',
        \App\Status\Status::EXPEDIE => 'btn-danger',
        \App\Status\Status::INJOIGNABLE => 'btn-danger',
        \App\Status\Status::INTERESSE => 'btn-info',
        \App\Status\Status::NON_INTERESSE => 'btn-dangerv',
        \App\Status\Status::MANQUE_DE_STOCK => 'btn-danger',
        \App\Status\Status::PAS_DE_REPONSE => 'btn-warning',
        \App\Status\Status::PAS_DE_REPONSE_2 => 'btn-warning',
        \App\Status\Status::PAS_DE_REPONSE_3 => 'btn-warning',
        \App\Status\Status::PAS_DE_REPONSE_4 => 'btn-warning',
        \App\Status\Status::PAS_DE_REPONSE_5 => 'btn-warning',
        \App\Status\Status::RECONFIRMER => 'btn-info',
        \App\Status\Status::REFUSE => 'btn-danger',
        \App\Status\Status::REPORTE => 'btn-dark',
        \App\Status\Status::RETOURNE => 'btn-info',

    ],

];
