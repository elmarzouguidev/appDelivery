<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreatePageSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('page.product_condition', "Condition general d'jouter un produit ");
    }
}
