<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Source\SourceFormRequest;
use App\Models\Sameleon\Integration;
use App\Models\Sameleon\Source;
use App\Repositories\Integration\IntegrationInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class SourceController extends Controller
{

    const SEPARATOR = '-';

    const SLASH = '/';

    const PREFIX = 'sameleonHooks';

    public function index()
    {
        $sources = Source::whereUserId(auth()->id())
            ->whereUserUuid(auth()->user()->uuid)
            ->get();
        $integrations = app(IntegrationInterface::class)->getIntegrations();

        return view('Sameleon.Admin.Setting.source_integration.index', compact('sources', 'integrations'));
    }

    public function store(SourceFormRequest $request)
    {

        $integration = Integration::whereUuid($request->integration)->first();

        $source = new Source();

        $source->name = $request->name;

        $source->domain = $request->domain;

        $source->integration_id = $integration->id;

        $source->integration_uuid = $integration->uuid;

        $source->client()->associate(auth()->user());

        $source->user_uuid = auth()->user()->uuid;

        $source->platform = $integration->slug;

        $source->header = $this->generateHeader($integration->slug);

        $source->route = $this->generateRoutes($request->domain, $integration->slug);

        $source->full_url = getDomainName() . $source->route;

        $source->secret = $this->generateSecret();

        $source->save();

        return redirect()->back()->with('success', "La source a été ajouter");
    }

    public function generateRoutes($name, $platform)
    {

        $pftm = $this->generatePlatform($platform);

        return  self::PREFIX . self::SLASH . $pftm . self::SLASH . Str::slug($name) . self::SEPARATOR . Str::uuid() . '/' . auth()->user()->uuid;
    }

    public function generateSecret()
    {
        return Str::random(32);
    }

    public function generatePlatform($platform)
    {

        switch ($platform) {

            case 'woocommerce':
                return 'x-wc';
                break;
            case 'shopify':
                return 'x-shopify';
                break;
            case 'elementor':
                return 'x-elementor';
                break;
            default:
                return 'x-sameleon';
        }
    }

    public function generateHeader($platform)
    {

        switch ($platform) {
            case 'woocommerce':
                return 'x-wc-webhook-signature';
                break;
            case 'shopify':
                return 'X-Shopify-Hmac-Sha256';
                break;
            case 'elementor':
                return 'elementor-signature';
                break;
            case 'clickFunnels':
                return 'clickfunnels-signature-header';
                break;
            case 'ebay':
                return 'ebay-signature-header';
                break;
            default:
                return 'sameleon-signature';
        }
        //  $this->headerName = $header;
    }
}
