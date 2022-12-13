<?php

namespace App\Http\Middleware\Hooks;

use App\Models\Sameleon\Source;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyWoocommerceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handleOne($request, Closure $next)
    {

        $user =  substr($request->route()->uri(), strpos($request->route()->uri(), "@") + 1);

        $sourceData = Source::whereUserUuid($user)->where('platform', 'woocommerce')->first();

        $wp_signature = $request->header('x-wc-webhook-signature') || $request->header('X-Wc-Webhook-Signature');

        $get_hmac = base64_encode(hash_hmac('sha256', $wp_signature, $sourceData->secret ?? null, true));

        dd($sourceData, $wp_signature, $get_hmac);
        Log::debug($request->header());
        Log::debug($wp_signature);
        Log::debug($get_hmac);
        return $next($request);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {

        /**
         *   'user-agent' => 
            array (
                0 => 'WooCommerce/7.1.1 Hookshot (WordPress/6.1.1)',
            ),
         */
        $headers = collect($request->header())->transform(function ($item) {
            Log::debug($item);
        });

        $signature = $request->header('user-agent') || $request->header('User-Agent');

        if ($signature !== 'WooCommerce/7.1.1 Hookshot (WordPress/6.1.1)') {
            Log::debug($signature);
            Log::debug('false');
        
            return abort(403);
        }

        return $next($request);
    }
}
