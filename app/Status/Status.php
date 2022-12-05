<?php

namespace App\Status;

use ReflectionClass;

class Status
{

    public const NON_TRAITE = 1;
    public const ANNULE = 2;
    public const LIVRE = 3;
    public const CHANGE = 4;
    public const ENCOURS = 5;
    public const EXPEDIE = 6;
    public const INJOIGNABLE = 7;
    public const INTERESSE = 8;
    public const MANQUE_DE_STOCK = 9;
    public const PAS_DE_REPONSE = 10;
    public const RECONFIRMER = 11;
    public const REFUSE = 12;
    public const REPORTE = 13;
    public const RETOURNE = 14;

    public const NON_INTERESSE = 15;


    public static function getStatus(): array
    {
        $reflect = new ReflectionClass(self::class);

        return $reflect->getConstants();
    }
}
