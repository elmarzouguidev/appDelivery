<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateDocumentSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('document.invoice_prefix', 'FACT-');
        $this->migrator->add('document.invoice_start', 1);

    }
}
