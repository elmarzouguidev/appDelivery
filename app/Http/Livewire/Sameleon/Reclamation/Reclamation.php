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
    public $canResponse = false;
    public $reclamation;

    public function render()
    {
        if (auth()->user()->hasRole('Client')) {

            $commands   = Command::where('user_id', auth()->id())
                ->where('user_uuid', auth()->user()->uuid)
                ->select(['id', 'code'])->get();
            $complaints =  SameleonReclamation::where('user_id', auth()->id())
                ->with('command')
                ->whereActive(true)
                ->get();
        } else {
            $commands   = Command::select(['id', 'code'])->get();
            $complaints =  SameleonReclamation::with('user', 'command')
                ->whereActive(true)
                ->get();
        }
        return view('livewire.sameleon.reclamation.reclamation', compact('complaints', 'commands'));
    }

    public function addComplaint()
    {
        dd("Woowah");
    }

    public function responseToCompnail(SameleonReclamation $reclamation)
    {
        
        $this->canResponse = true;
        $this->reclamation = $reclamation;
        $this->dispatchBrowserEvent('response-modal');
    }
}
