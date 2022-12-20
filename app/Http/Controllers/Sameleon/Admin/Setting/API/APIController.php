<?php

namespace App\Http\Controllers\Sameleon\Admin\Setting\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class APIController extends Controller
{
    public function index()
    {
        return view('Sameleon.Admin.Setting.api_integration.index');
    }

    public function createToken()
    {
        // $token = auth()->user()->createToken(auth()->user()->email);
        $secretToken = Str::random(32);

        $publicToken = Str::random(16);

        auth()->user()->update(['public_key_api' => $publicToken, 'secret_key_api' => $secretToken]);

        return redirect()->back()->with('success', 'la clé  a éte crée avec success');
    }
}
