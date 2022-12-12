<?php

namespace App\Http\Controllers\Sameleon\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Tag\TagFormRequest;
use App\Models\Sameleon\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{


    public function index()
    {
        $tags = Tag::all();

        return view('Sameleon.Admin.Tag.index', compact('tags'));
    }

    public function store(TagFormRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->color = $request->color;
        $tag->save();
        return redirect(route('admin:tags'))->with('success', "Le tag a été ajouté avec succès");
    }

    public function activate(Request $request)
    {
        $request->validate(['tagId' => 'required', 'uuid']);

        $tag = tag::whereUuid($request->tagId)->firstOrFail();

        if ($tag) {

            $tag->update(['active' => !$tag->active]);

            $tag->active ? $msg = "activé" : $msg = "desactivé";

            return redirect()->back()->with('success', "le tag a été $msg avec success");
        }

        return redirect()->back()->with('error', 'error !!!');
    }
    
    public function delete(Request $request)
    {
        $request->validate(['tagId' => 'required|uuid']);

        $tag = Tag::whereUuid($request->tagId)->firstOrFail();

        if ($tag) {

            $tag->delete();

            return redirect()->back()->with('success', "le tag a été supprimer avec success");
        }
        return redirect()->back()->with('error', 'Error ...');
    }
}
