<?php

return [

    /*
    |--------------------------------------------------------------------------
    | E.VA.
    |--------------------------------------------------------------------------
    |
    | https://e-va.io service configuration
    |
     */

    'apikey' => env('EVA_APIKEY', 'null'),

    'allow_when_service_unavailable' => env('EVA_SERVICE_UNAVAILABLE', true),
    'allow_when_unkown' => env('EVA_UNKOWN', false),
    'allow_when_invalid' => env('EVA_INVALID', false),
    'allow_when_risky' => env('EVA_RISKY', false),
    'allow_when_safe' => env('EVA_SAFE', true),

];
