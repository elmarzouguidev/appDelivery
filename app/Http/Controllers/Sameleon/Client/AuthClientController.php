<?php

namespace App\Http\Controllers\Sameleon\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthClientController extends Controller
{
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest:client')->except('logout');
    }

    public function loginForm()
    {
        return view('Sameleon.Client.Auth.login');
    }

    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 204)
            : redirect(route('client:auth:login'));
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route('client:home');
    }

        /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('client');
    }
}
