<?php


namespace App\Repositories\Integration;

interface IntegrationInterface
{


    public function getIntegrations();

    public function getIntegration(int $id);
}
