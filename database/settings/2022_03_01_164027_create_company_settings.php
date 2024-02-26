<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateCompanySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.name', 'SAMELEON');
        $this->migrator->add('company.website', 'https://sameleon.ma');
        $this->migrator->add('company.logo', 'logo.png');
        $this->migrator->add('company.addresse', 'Lisasfa casablanca');
        $this->migrator->add('company.telephone_a', '+212660405003');
        $this->migrator->add('company.telephone_b', '+212660405004');
        $this->migrator->add('company.email', 'info@sameleon.ma');
        $this->migrator->add('company.rc', '507491');
        $this->migrator->add('company.ice', '002749195000015');
        $this->migrator->add('company.cnss', null);
        $this->migrator->add('company.patente', '34778172');
        $this->migrator->add('company.if', '50316039');
    }
}
