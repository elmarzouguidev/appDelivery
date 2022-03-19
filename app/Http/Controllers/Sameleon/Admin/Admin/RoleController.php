<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Role\RoleFormRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);

        return view('Sameleon.Admin.Role.index', compact('roles'));
    }

    public function store(RoleFormRequest $request)
    {
        // dd('Yeeee');

        Role::create(['name' => $request->name, 'guard_name' => $request->guard_name]);

        return redirect()->back()->with('success', "La Permission  a éte ajouter  avec success");
    }

    public function delete(Request $request)
    {

        $request->validate(['roleId' => 'required|integer']);

        $permission = Role::findOrFail($request->roleId);

        if ($permission) {

            // $permission->delete();

            return redirect()->back()->with('success', "Le Role  a éte supprimer  avec success");
        }
        return redirect()->back()->with('success', "un problem a été détécter ... ");
    }
}
