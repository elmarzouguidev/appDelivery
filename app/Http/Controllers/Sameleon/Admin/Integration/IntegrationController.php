<?php

namespace App\Http\Controllers\Sameleon\Admin\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Integration\IntegrationFormRequest;
use App\Http\Requests\Sameleon\Integration\IntegrationUpdateFormRequest;
use App\Models\Sameleon\Integration;
use App\Repositories\Integration\IntegrationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntegrationController extends Controller
{
    public function index()
    {
        $integrations = app(IntegrationInterface::class)->getIntegrations();

        return view('Sameleon.Admin.Integration.index', compact('integrations'));
    }

    public function create()
    {
        return view('Sameleon.Admin.Integration.create.index');
    }

    public function store(IntegrationFormRequest $request)
    {
        $integration = new Integration();

        $integration->name = $request->name;

        $integration->description = $request->description;

        if ($request->hasFile('logo')) {
            $integration->logo = $request->file('logo')->store('integrations', ['disk' => 'public']);
        }

        $integration->save();

        return back()->with('success', 'Integration Ajouté ');
    }

    public function edit(Integration $integration)
    {
        return view('Sameleon.Admin.Integration.edit.index', compact('integration'));
    }

    public function update(IntegrationUpdateFormRequest $request, Integration $integration)
    {
        $integration->name = $request->name;
        $integration->slug = $request->slug;
        $integration->description = $request->description;

        if ($request->hasFile('logo')) {
            $old = $integration->logo;

            $integration->logo = $request->file('logo')->store('integrations', ['disk' => 'public']);

            Storage::disk('public')->delete($old);
        }

        $integration->save();
    }

    public function activate(Request $request)
    {
        $request->validate(['integrationId' => 'required', 'uuid']);

        $integration = Integration::whereUuid($request->integrationId)->firstOrFail();

        if ($integration) {
            $integration->update(['active' => ! $integration->active]);

            $integration->active ? $msg = 'activé' : $msg = 'desactivé';

            return redirect()->back()->with('success', "le module a été $msg avec success");
        }

        return redirect()->back()->with('error', 'error !!!');
    }

    public function delete(Request $request)
    {
        $integrationId = $request->validate(['integrationId' => 'required|uuid']);

        $integration = Integration::whereUuid($integrationId)->first();

        if ($integration) {
            //$integration->delete();

            return redirect()->back()->with('success', 'Integration Deleted Successfully');
        }

        return redirect()->back()->with('error', 'Integration error');
    }
}
