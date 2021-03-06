<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => true,
    'allowedOrigins' => ['http://localhost:8080', 'https://blueway.devi.tools', 'https://bluewaycursos.com.br'],
    'allowedMethods' => ['*'],
    'allowedHeaders' => ['Authorization', 'PrivateToken', 'Bearer', 'Context', 'Device', 'Content-Type'],
    'exposedHeaders' => ['Authorization', 'PrivateToken', 'Bearer', 'Context', 'Device', 'Content-Type'],
    'maxAge' => 0,

];
