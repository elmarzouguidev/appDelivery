<?php

namespace App\Http\Controllers\Authentification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Password;

class DeliveryForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('Sameleon.Admin.SubDelivery.Auth.Password.forgot');
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
}
