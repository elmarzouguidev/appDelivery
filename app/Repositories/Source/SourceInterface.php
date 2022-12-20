<?php

namespace App\Repositories\Source;

interface SourceInterface
{
    public function getSources();

    public function getSource(int $id);

    public function usersSources();
}
