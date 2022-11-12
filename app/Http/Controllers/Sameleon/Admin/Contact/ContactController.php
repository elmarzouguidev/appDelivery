<?php

namespace App\Http\Controllers\Sameleon\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\Condition;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        
        $globalCondition = Condition::whereType('global')->first(); 

        return view('Sameleon.Admin.Contact.index',compact('globalCondition'));
    }

    public function store()
    {
        
    }
}
