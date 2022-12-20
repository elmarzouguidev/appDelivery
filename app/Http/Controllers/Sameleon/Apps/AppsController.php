<?php

namespace App\Http\Controllers\Sameleon\Apps;

use App\Http\Controllers\Controller;
use App\Repositories\Integration\IntegrationInterface;

class AppsController extends Controller
{
    public function index()
    {
        $apps = app(IntegrationInterface::class)->getIntegrations();

        return view('Sameleon.Admin.Apps.index', compact('apps'));
    }
}
