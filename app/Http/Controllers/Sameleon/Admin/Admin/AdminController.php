<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Admin\AdminFormRequest;
use App\Http\Requests\Sameleon\Admin\AdminPermissionFormRequest;
use App\Http\Requests\Sameleon\Admin\AdminUpdateFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('Sameleon.Admin.Admin.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('Sameleon.Admin.Admin.__create.index', compact('roles'));
    }

    public function store(AdminFormRequest $request)
    {
        //dd($request->all());

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        //$user->super_admin = $request->super_admin;
        $user->save();

        $user->assignRole('Admin');

        return redirect()->back()->with('success', "L'ajoute a éte effectuer avec success");
    }

    public function edit(User $user)
    {

        $permissions = Permission::all();
        $roles = Role::all();
        return view('Sameleon.Admin.Admin.__edit.index', compact('user', 'permissions', 'roles'));
    }

    public function update(AdminUpdateFormRequest $request, User $user)
    {
        //dd($request->all(),"####");

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->save();

        //$user->syncRoles($request->role);

        //$user->syncPermissions($request->permissions);

        return redirect()->back()->with('success', "Update  a éte effectuer avec success");
    }

    public function syncPermission(AdminPermissionFormRequest $request, User $admin)
    {

        $admin = User::findOrFail($admin);

        $admin->syncPermissions($request->permissions);

        return redirect()->back()->with('success', "Syn permissions   a éte effectuer avec success");
    }

    public function delete(Request $request)
    {

        $request->validate(['userId'=> 'required|uuid']);
        $admin = User::whereUuid($request->userId)->firstOrFail();

        if ($admin) {

           // $admin->delete();

            return redirect()->back()->with('success', "L' Admin  a éte supprimer  avec success");
        }
        return redirect()->back()->with('success', "un problem a été détécter ... ");
    }
}
