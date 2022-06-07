<?php

use Illuminate\Support\Facades\Route;

$url  = loadSetting('WebHooks')->route;

Route::webhooks($url,'webhooker');


//
