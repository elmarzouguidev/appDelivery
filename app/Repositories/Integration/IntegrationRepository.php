<?php


namespace App\Repositories\Integration;

use App\Models\Sameleon\Integration;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class IntegrationRepository extends AppRepository implements IntegrationInterface
{

    private $integration;

    private $instance;

    public function __construct(Integration $integration)
    {
        $this->integration = $integration;
    }

    public function __instance(): Integration
    {
        if (!$this->instance) {
            $this->instance = $this->integration;
        }

        return $this->instance;
    }

    /**
     * @return Integration[]|Collection|string[]
     */
    public function getIntegrations()
    {
        if ($this->useCache()) {

            return $this->setCache()->remember('all_integrations_cache', $this->timeToLive(), function () {
                return $this->integration->get();
            });
        } else {

            return $this->integration->get();
        }
        return [];
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getIntegration(int $id)
    {
        return $this->integration->find($id);
    }
}
