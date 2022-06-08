<?php

namespace App\Hooks\Validator\Repository;

use Illuminate\Http\Request;

use Spatie\WebhookClient\SignatureValidator\SignatureValidator;
use Spatie\WebhookClient\WebhookConfig;

use Spatie\WebhookClient\Exceptions\InvalidConfig;

class HooksValidation implements SignatureValidator
{

    protected $state = false;

    public function isValid(Request $request,  WebhookConfig $config): bool
    {

        if ($this->state) {

            logger($request->segments());
            
            return true;
            
        } else {

            $signature = $request->header($config->signatureHeaderName);

            if (!$signature) {

                logger('Ohh signature not found');
                return false;
            }

            $signingSecret = $config->signingSecret;

            if (empty($signingSecret)) {

                throw InvalidConfig::signingSecretNotSet();
            }

            $computedSignature = base64_encode(hash_hmac('sha256', $request->getContent(), $signingSecret, true));

            //  $computedSignature = hash_hmac('sha256', $request->getContent(), $signingSecret);

            return hash_equals($signature, $computedSignature);
        }
    }
}
