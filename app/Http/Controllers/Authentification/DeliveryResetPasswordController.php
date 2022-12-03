<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class DeliveryResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;


    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('Sameleon.Admin.SubDelivery.Auth.Password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    private function redirectTo()
    {
        return route('delivery:home');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('deliveries');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('delivery');
    }
}
