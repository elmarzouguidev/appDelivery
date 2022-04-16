<?php

namespace App\Http\Livewire\Sameleon\Reclamation;

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Comment;
use App\Models\Sameleon\Reclamation as SameleonReclamation;
use Livewire\Component;

class Reclamation extends Component
{
    public $command;
    public $messgae;

    public function render()
    {
        if (auth()->user()->hasRole('Client')) {

            $commands   = Command::where('user_id',auth()->id())->select(['id','code'])->get();
            $complaints =  SameleonReclamation::where('user_id', auth()->id())
                ->with('command')
                ->whereActive(true)
                ->get();
        } else {
            $commands   = Command::select(['id','code'])->get();
            $complaints =  SameleonReclamation::with('user', 'command')
                ->whereActive(true)
                ->get();
        }
        return view('livewire.sameleon.reclamation.reclamation',compact('complaints','commands'));
    }

    public function addComplaint()
    {
        dd("Woowah");
    }
}
