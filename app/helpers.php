<?php

use App\Settings\CompanySettings;
use App\Settings\DocumentSettings;

if (!function_exists('getDocument')) {
    function getDocument(): DocumentSettings
    {
        return app(DocumentSettings::class);
    }
}

if (!function_exists('getCompany')) {
    function getCompany(): CompanySettings
    {
        return app(CompanySettings::class);
    }
}


if (!function_exists('getDocument')) {
    function getImagePath()
    {
        return asset('storage/') . '/';
    }
}

if (!function_exists('loadSetting')) {
    function loadSetting($abstract)
    {
        return app('App\Settings\\' . $abstract . 'Settings');
    }
}

if (!function_exists('getDomainName')) {
    function getDomainName()
    {
        return request()->getSchemeAndHttpHost() . '/';
    }
}

/*****Auth guard helpers *****/

if (!function_exists('isDelivery')) {
    function isDelivery()
    {
        return auth('delivery')->check() ? true : false;
    }
}

if (!function_exists('delivery')) {
    function delivery()
    {
        return isDelivery() ?  auth('delivery')->user() : null;
    }
}

if (!function_exists('isClient')) {
    function isClient()
    {
        return auth()->check() && auth()->user()->hasRole('Client') ? true : false;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        return auth()->check() && auth()->user()->hasRole('SuperAdmin') ? true : false;
    }
}
