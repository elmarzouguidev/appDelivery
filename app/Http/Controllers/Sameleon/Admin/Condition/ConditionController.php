<?php

namespace App\Http\Controllers\Sameleon\Admin\Condition;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Condition\ConditionFormRequest;
use App\Http\Requests\Sameleon\Condition\ConditionUpdateFormRequest;
use App\Models\Sameleon\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConditionController extends Controller
{
    public function index()
    {

        $conditions = Condition::all();

        return view('Sameleon.Admin.Condition.index', compact('conditions'));
    }

    public function store(ConditionFormRequest $request)
    {
        $condition = new Condition();
        $condition->title = $request->title;
        $condition->description = $request->description;
        $condition->type = $request->type;
        $condition->save();

        return redirect(route('admin:conditions.index'))->with('success', "La condition a été ajouté avec succès");
    }

    public function edit(Condition $condition)
    {
        return view('Sameleon.Admin.Condition.edit.index', compact('condition'));
    }

    public function update(ConditionUpdateFormRequest $request , Condition $condition)
    {

        $condition->title = $request->title;
        $condition->description = $request->description;
        $condition->type = $request->type;
        $condition->save(); 

        return redirect(route('admin:conditions.index'))->with('success', "La condition a été modifié avec succès");

    }

    public function activate(Request $request)
    {
        
        $request->validate(['conditionId' => 'required', 'uuid']);

        $condition = Condition::whereUuid($request->conditionId)->firstOrFail();

        if ($condition) {

            $condition->update(['active' => !$condition->active]);

            $condition->active ? $msg = "activé" : $msg = "desactivé";

            return redirect()->back()->with('success', "la condition a été $msg avec success");
        }

        return redirect()->back()->with('error', 'error !!!');
    }

    public function delete(Request $request)
    {

        $request->validate(['conditionId' => 'required|uuid']);

        $condition = Condition::whereUuid($request->conditionId)->firstOrFail();

        if ($condition) {

            $condition->delete();

            return redirect()->back()->with('success', "la condition a été supprimer avec success");
        }
        return redirect()->back()->with('error', 'Error ...');
    }

 
}
