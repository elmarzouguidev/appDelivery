<?php


namespace App\Repositories\Source;

use App\Models\Sameleon\Source;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class SourceRepository extends AppRepository implements SourceInterface
{

    private $source;

    private $instance;

    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    public function __instance(): Source
    {
        if (!$this->instance) {
            $this->instance = $this->source;
        }

        return $this->instance;
    }

    /**
     * @return Source[]|Collection|string[]
     */
    public function getSources()
    {
        if ($this->useCache()) {

            return $this->setCache()->remember('all_sources_cache', $this->timeToLive(), function () {

                return $this->source->get();
            });

            return $this->source->get();
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getSource(int $id)
    {
        return $this->source->find($id);
    }
}
