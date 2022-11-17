<?php

namespace App\Http\Controllers\Sameleon\Admin\SubDelivery\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthSubDeliveryController extends Controller
{
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest:delivery')->except('logout');
    }

    public function loginForm(Request $request)
    {
        
        Session::flush();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('Sameleon.Admin.SubDelivery.Auth.login');
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

        /**Logout from other devices */
        Auth::logoutOtherDevices($request->password);

        if (!$this->guard()->user()->isActive()) {

            $this->guard()->logout();

            return redirect(route('delivery:auth:login'))->withErrors(["Votre compte n'est pas encore activé"]);
        }
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
            : redirect(route('delivery:auth:login'));
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route('delivery:home');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('delivery');
    }
}
