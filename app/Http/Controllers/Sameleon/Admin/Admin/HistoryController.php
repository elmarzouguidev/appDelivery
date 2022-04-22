<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sameleon\UserLogin;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {

        $connections = auth()->user()->withLastLogin() ?? [];

        $sessionsAll = auth()->user()->GetLoginHistory() ?? [];

        return view('Sameleon.Admin.History.index', compact('connections', 'sessionsAll'));
    }

    public function delete()
    {
        // $histories = auth()->user()->loginHistory()->get();

        UserLogin::whereIn('user_id', [auth()->id()])->delete();

        return redirect()->back();
    }
}
