<?php

/**
 * Author    : Elmarzougui Abdelghafour (Haymacproduction)
 * website   : https://www.elmarzougui.com
 * linkedin  : https://www.linkedin.com/in/devscript/
 * facebook  : https://www.facebook.com/devscript
 * twitter   : https://twitter.com/devscriptt
 * createdAt : 13/décembre/2020
 **/

namespace App\Settings\Repositories;

use App\Http\Requests\Settings\Hooks\HooksRequest;

use App\Settings\WebHooksSettings;
use Illuminate\Support\Str;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
class WebHooksRepository
{

    const SEPARATOR = '-';

    const SLASH = '/';

    const PREFIX = 'appwebhook';

    public function __construct(WebHooksSettings $settings, HooksRequest $request)
    {

        $platform = $settings->app_platform;
        // $settings->name = $request->input('name');
        $settings->header = $request->input('header');
        $settings->secret = $request->input('secret');
        $settings->domain = $request->input('domain');
        if ($platform !== $request->input('platform')) {

            $settings->app_platform = $request->input('platform');

            $settings->route = $this->generateRoutes($request->platform);

            $headerSignature = $this->getPlatfromHeaderSignature($request->platform);

            $env = DotenvEditor::load();

            $env->setKey('WEBHOOK_PLATFORM', $request->input('platform'));
            $env->setKey('WEBHOOK_HEADER_SIGNATURE', $headerSignature);
            $env->save();
        }

        /*$settings->validated = $request->input('validated');
        $settings->active = $request->input('active');*/

        $settings->validated = $request->has('validated') ? true : false;
        $settings->active = $request->has('active') ? true : false;

        $settings->save();

    }

    public function generateRoutes($name)
    {
        return  self::PREFIX . self::SLASH . Str::slug($name) . self::SEPARATOR . Str::uuid();
    }

    public function getPlatfromHeaderSignature($platform)
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
               return 'appwebhook-haymacproduction';
        }
      //  $this->headerName = $header;
    }
}
