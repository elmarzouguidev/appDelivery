<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddFieldsToCompanySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.bank_name', 'CIH');
        $this->migrator->add('company.bank_rib', '111452365214524587452145');
    }
}
