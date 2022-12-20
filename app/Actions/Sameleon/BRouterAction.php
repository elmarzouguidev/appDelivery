<?php

namespace App\Actions\Sameleon;

use App\Models\Sameleon\BRouter;
use App\Models\Sameleon\Command;
use App\Status\Status;
use Lorisleiva\Actions\Concerns\AsAction;

class BRouterAction
{
    use AsAction;

    protected $articles;

    public function handle()
    {
        BRouter::doesntHave('articles')
            ->get()
            ->each(function ($bon) {
                $bon->delete();
            });

        Command::whereNotIn('status', [Status::RETOURNE])
            ->has('BRarticles')
            ->with('BRarticles')
            ->get()
            ->each(function ($command) {
                $command->BRarticles->each->delete();
            });
    }
}
