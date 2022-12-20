<?php

namespace App\Status;

class DeliveryStatus
{
    public const D_NON_TRAITE = 1;

    public const D_ANNULE = 2;

    public const D_LIVRE = 3;

    public const D_CHANGE = 4;

    public const D_ENCOURS = 5;

    public const D_INJOIGNABLE = 6;

    public const D_INTERESSE = 7;

    public const D_MANQUE_DE_STOCK = 8;

    public const D_PAS_DE_REPONSE = 9;

    public const D_RECONFIRMER = 10;

    public const D_REFUSE = 11;

    public const D_REPORTE = 12;

    public const D_RETOURNE = 13;

    public const D_NON_INTERESSE = 14;
}
