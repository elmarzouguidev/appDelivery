<?php

namespace App\Http\Controllers\Sameleon\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('Sameleon.Admin.Contact.index');
    }
}
