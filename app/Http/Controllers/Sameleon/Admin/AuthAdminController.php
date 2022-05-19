<?php

namespace App\Http\Controllers\Sameleon\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm()
    {
        return view('Sameleon.Admin.Auth.login');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        /*if (!Auth::user()->active) {

            Auth::logout();

            return redirect(route('admin:auth:login'))->withErrors(["votre compte n'est encore activé"]);
        }*/
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
            : redirect(route('admin:auth:login'));
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        if (auth()->user()->hasRole('Delivery')) {

            return route('admin:commands.index');

        } else {
            
            return route('admin:home');
        }
    }
}
