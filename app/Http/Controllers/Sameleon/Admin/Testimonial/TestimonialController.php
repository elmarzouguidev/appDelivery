<?php

namespace App\Http\Controllers\Sameleon\Admin\Testimonial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Testimonial\TestimonialFormRequest;
use App\Models\Sameleon\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();

        return view('Sameleon.Admin.Testimonial.index', compact('testimonials'));
    }

    public function store(TestimonialFormRequest $request)
    {
        $testimonial = new Testimonial();
        $testimonial->content = $request->content;
        $testimonial->client()->associate(auth()->user());
        $testimonial->save();

        return redirect(route('admin:testimonials'))->with('success', 'Le contentu a été ajouté avec succès');
    }

    public function activate(Request $request)
    {
        $request->validate(['testimonialId' => 'required', 'uuid']);

        $testimonial = Testimonial::whereUuid($request->testimonialId)->firstOrFail();

        if ($testimonial) {
            $testimonial->update(['approved' => ! $testimonial->approved]);

            $testimonial->approved ? $msg = 'activé' : $msg = 'desactivé';

            return redirect()->back()->with('success', "le contentu a été $msg avec success");
        }

        return redirect()->back()->with('error', 'error !!!');
    }
}
