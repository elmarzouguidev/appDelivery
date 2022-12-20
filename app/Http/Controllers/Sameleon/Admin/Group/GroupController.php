<?php

namespace App\Http\Controllers\Sameleon\Admin\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Group\GroupFormRequest;
use App\Http\Requests\Sameleon\Group\GroupUpdateFormRequest;
use App\Models\Sameleon\Group;
use App\Repositories\Admin\AdminInterface;
use App\Repositories\Group\GroupInterface;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = app(GroupInterface::class)->getGroups();

        $admins = app(AdminInterface::class)->getAdmins();

        return view('Sameleon.Admin.Group.index', compact('groups', 'admins'));
    }

    public function create()
    {
        $admins = app(AdminInterface::class)->getAdmins();

        return view('Sameleon.Admin.Group.create.index', compact('admins'));
    }

    public function store(GroupFormRequest $request)
    {
        $group = new Group();

        $group->name = $request->name;

        $group->description = $request->description;

        $group->moderator()->associate($request->admin);

        $group->save();

        return redirect()->back()->with('success', 'Group created Successfully');
    }

    public function edit(Group $group)
    {
        $admins = app(AdminInterface::class)->getAdmins();

        return view('Sameleon.Admin.Group.edit.index', compact('group', 'admins'));
    }

    public function update(GroupUpdateFormRequest $request, Group $group)
    {
        $group->name = $request->name;

        $group->description = $request->description;

        $group->moderator()->associate($request->admin);

        $group->save();

        return redirect()->back()->with('success', 'Group updated Successfully');
    }

    public function delete(Request $request)
    {
        $groupId = $request->validate(['groupId' => 'required|uuid']);

        $group = Group::whereUuid($groupId)->first();

        if ($group) {
            $group->delete();

            return redirect()->back()->with('success', 'Group Deleted Successfully');
        }

        return redirect()->back()->with('error', 'Group error');
    }

    public function activate()
    {
    }
}
