<?php

return

    [
        /*
        |--------------------------------------------------------------------------
        | Analytics reports site id
        |--------------------------------------------------------------------------
        |
        | This site id is used to retrieve and display Google Analytics statistics
        | in the admin-section. Should be something like ga:xxxxxxxx.
        |
        */

        'siteId' => '',

        /*
        |--------------------------------------------------------------------------
        | Cache Lifetime
        |--------------------------------------------------------------------------
        |
        | The amount of minutes the Google API responses will be cached.
        | If you set this to zero, the responses won't be cached at all.
        |
        */

        'cacheLifetime' => 60 * 24 * 2,

    ];
