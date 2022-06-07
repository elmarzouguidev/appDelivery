<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateWebHooksSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('webhooks.app_platform', 'elementor');
        $this->migrator->add('webhooks.name', 'shopify');
        $this->migrator->add('webhooks.header', 'X-Shopify-Hmac-Sha256');
        $this->migrator->add('webhooks.secret', 'haymacproduction');
        $this->migrator->add('webhooks.domain', 'haymac.shopify.com');
        $this->migrator->add('webhooks.route', 'elementorHooks');
        $this->migrator->add('webhooks.validated', true);
        $this->migrator->add('webhooks.active', true);
    }
}
