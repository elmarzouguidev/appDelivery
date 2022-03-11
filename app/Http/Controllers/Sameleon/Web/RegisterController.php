<?php

namespace App\Http\Controllers\Sameleon\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Register\RegisterFormRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    

    public function index()
    {
        return view('theme.Sameleon.Register.index');
    }

    public function store(RegisterFormRequest $request)
    {

    }
}
