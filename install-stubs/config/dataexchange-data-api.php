<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Default DataExchange Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish
    | to use as your default connection for all DataExchange work. Of course
    | you may use many connections at once using the DataExchange library.
    |
    */
    'default' => env('DX_CONNECTION', 'school'),

    /*
    |--------------------------------------------------------------------------
    | DataExchange Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the DataExchange connections setup for your application.
    |
    | Each have the following settings:
    |   - zone_id   Required    This is the Zone ID (GUID) given in your deployment credentials
    |   - url       Optional    This is the URL given in your deployment credentials
    |                           If null or missing then this defaults to:
    |                           https://uk.staging.dataexchange.education/rest/sif/requests
    |   - token     Required    This is the token given in your deployment credentials
    |                           It is strongly advised you store this token in your environment file
    |                           as this saves the token going into version control.
    |                           It is your responsibility to keep this token safe!
    |
    */
    'connections' => [
        'school' => [
            'zone_id' => env('SCHOOL_ZONE_ID'),
            'url' => null,
            'token' => env('SCHOOL_TOKEN'),
        ],
    ],
];
