<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Admin\AdminFormRequest;
use App\Http\Requests\Sameleon\Admin\AdminPermissionFormRequest;
use App\Http\Requests\Sameleon\Admin\AdminUpdateFormRequest;
use App\Models\Sameleon\User;
use App\Repositories\Admin\AdminInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    public function index()
    {

        $this->authorize('viewAny', User::class);

        $users = app(AdminInterface::class)->getAdmins();

        $permissions = Permission::where('type','admin')->get()->mapToGroups(function ($item, $key) {
            return [strstr($item['name'], '.', true) => ['name' => $item['name'], 'id' => $item['id']]];
        });

        return view('Sameleon.Admin.Admin.__normal_table.index', compact('users','permissions'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        //$roles = Role::all();

        $roles = Role::all()->reject(function ($role, $key) {
            return $role->name == 'Developper' || 
            $role->name == 'Client' || 
            $role->name == 'Delivery'||
            $role->name == 'SubDelivery' || 
            $role->name == 'DeliveryEntreprise';
        });

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
        $user->is_admin = true;
        $user->save();

        $user->assignRole($request->role);

        return redirect()->back()->with('success', "L'ajoute a éte effectuer avec success");
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        abort_if($user->email == 'abdelgha4or@gmail.com', 403,"vous ne pouvez editer ce utilisateur");

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


    public function syncPermission(AdminPermissionFormRequest $request)
    {

        $admin = User::Role(['Admin','SuperAdmin'])->whereUuid($request->adminId)->firstOrFail();

        //dd('yes here in Admins','##',$admin,'permissions',$request->permissions);
        //abort_if($client->email === 'abdelgha4or@gmail.com' || $client->hasRole('Developper'), 403);

        $admin->syncPermissions($request->permissions);

        return redirect()->back()->with('success', "Les permissions sont synchronisée avec succès");
    }

    public function delete(Request $request)
    {

        $request->validate(['userId' => 'required|uuid']);

        $admin = User::whereUuid($request->userId)->firstOrFail();

        $this->authorize('delete', $admin);

        abort_if($admin->email == 'abdelgha4or@gmail.com', 403,"vous ne pouvez suppumer ce utilisateur");

        if ($admin) {

            // $admin->delete();

            return redirect()->back()->with('success', "L' Admin  a éte supprimer  avec success");
        }
        return redirect()->back()->with('success', "un problem a été détécter ... ");
    }
}
