<?php

namespace NaimKhalifa\GoogleCloudTranslation;

use Google\Cloud\Translate\V2\TranslateClient;

/**
 * The client proxy is used to inject the api key into the translate client.
 * This is done to make the translate client testable.
 */
class TranslateClientProxy extends TranslateClient
{
    public function __construct()
    {
        parent::__construct([
            'key' => config('google-cloud-translation.api_key'),
        ]);
    }
}
