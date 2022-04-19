<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Permission\PermissionFormRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    
    public function index()
    {
        $permissions = Permission::paginate(10);

        return view('Sameleon.Admin.Permission.index', compact('permissions'));
    }

    public function store(PermissionFormRequest $request)
    {
       // dd('Yeeee');

        Permission::create(['name' => $request->name, 'guard_name' => $request->guard_name]);

        return redirect()->back()->with('success', "La Permission  a éte ajouter  avec success");
    }

    public function delete(Request $request)
    {

        $request->validate(['permissionId' => 'required|integer']);

        $permission = Permission::findOrFail($request->permissionId);

        if ($permission) {

            // $permission->delete();

            return redirect()->back()->with('success', "La Permission  a éte supprimer  avec success");
        }
        return redirect()->back()->with('success', "un problem a été détécter ... ");
    }
}
