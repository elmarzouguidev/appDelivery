<?php


namespace App\Hooks\Repository;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class HookRepository extends ProcessWebhookJob implements HookRepositoryInterface
{

    public function getAllData()
    {
        return $this->webhookCall;
    }

}
