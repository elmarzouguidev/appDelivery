<?php

namespace App\Http\Controllers\Sameleon\Admin\Admin;

use App\Hooks\Validation\CheckIsWordpress;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sameleon\Source\SourceFormRequest;
use App\Models\Sameleon\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class SourceController extends Controller
{

    const SEPARATOR = '-';

    const SLASH = '/';

    const PREFIX = 'hooks';

    public function index()
    {
      
        $hook = (new CheckIsWordpress)->check('https://test.sameleon-express.ma')->isWoocommerce();

        dd($hook);
        
        $sources = Source::whereUserId(auth()->id())
            ->whereUserUuid(auth()->user()->uuid)
            ->get();

        return view('Sameleon.Admin.Setting.source_integration.index', compact('sources'));
    }

    public function store(SourceFormRequest $request)
    {

        $source = new Source();

        $source->name = $request->name;

        $source->platform = $request->integration;

        $source->domain = $request->domain;

        $source->route_name = str_replace(' ', '', $request->domain) . strtolower(Str::random(4));

        $source->client()->associate(auth()->user());

        $source->user_uuid = auth()->user()->uuid;

        $source->header = $this->generateHeader($request->integration);

        $source->route = $this->generateRoutes($request->integration);

        $source->full_url = getDomainName() . $source->route;

        $source->secret = $this->generateSecret();

        $source->save();

        return redirect()->back()->with('success', "La source a été ajouter");
    }

    public function generateRoutes($platform)
    {

        $pftm = $this->generatePlatform($platform);

        return  self::PREFIX .
            self::SLASH . $pftm .
            self::SEPARATOR . strtolower(Str::random(4)) . '/@' . auth()->user()->uuid;
    }

    public function generateSecret()
    {
        return Str::random(32);
    }

    public function generatePlatform($platform)
    {

        switch ($platform) {

            case 'woocommerce':
                return 'wc';
                break;
            case 'shopify':
                return 'shopify';
                break;
            case 'elementor':
                return 'elementor';
                break;
            default:
                return 'sameleon';
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

    public function delete(Request $request)
    {
        $request->validate(['sourceId' => 'required|uuid']);

        $source = Source::whereUuid($request->sourceId)->firstOrFail();

        if ($source) {

            $source->delete();

            return redirect()->back()->with('success', "la source  a été supprimer avec success");
        }
        return redirect()->back()->with('error', 'Error ...');
    }
}
