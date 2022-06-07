<?php

use App\Settings\CompanySettings;
use App\Settings\DocumentSettings;


function getDocument(): DocumentSettings
{
    return app(DocumentSettings::class);
}

function getCompany(): CompanySettings
{
    return app(CompanySettings::class);
}



function getImagePath()
{
    return asset('storage/') . '/';
}


function loadSetting($abstract)
{
    return app('App\Settings\\' . $abstract . 'Settings');
}

function getDomainName()
{
    return request()->getSchemeAndHttpHost() . '/';
}
