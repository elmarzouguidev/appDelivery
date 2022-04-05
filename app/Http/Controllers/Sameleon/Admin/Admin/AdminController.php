<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Admin\AdminFormRequest;
use App\Http\Requests\Sameleon\Admin\AdminPermissionFormRequest;
use App\Http\Requests\Sameleon\Admin\AdminUpdateFormRequest;
use App\Models\Sameleon\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function index()
    {

        $this->authorize('viewAny', User::class);

        $users = User::role(['Admin', 'SuperAdmin'])->get();

        return view('Sameleon.Admin.Admin.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::all();

        return view('Sameleon.Admin.Admin.__create.index', compact('roles'));
    }

    public function store(AdminFormRequest $request)
    {
        $this->authorize('create', User::class);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->addresse = $request->addresse;
        $user->password = Hash::make($request->password);
        //$user->super_admin = $request->super_admin;
        $user->save();

        $user->assignRole('SuperAdmin');

        return redirect()->back()->with('success', "L'ajoute a éte effectuer avec success");
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $permissions = Permission::all();

        $roles = Role::all();

        return view('Sameleon.Admin.Admin.__edit.index', compact('user', 'permissions', 'roles'));
    }

    public function update(AdminUpdateFormRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->addresse = $request->addresse;

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

        $request->validate(['userId' => 'required|uuid']);

        $admin = User::whereUuid($request->userId)->firstOrFail();

        $this->authorize('delete', $admin);

        if ($admin) {

            // $admin->delete();

            return redirect()->back()->with('success', "L' Admin  a éte supprimer  avec success");
        }
        return redirect()->back()->with('success', "un problem a été détécter ... ");
    }
}
