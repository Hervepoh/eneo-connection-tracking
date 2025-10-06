<?php

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Cross-Origin Resource Sharing (CORS) Configuration
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
 */
class Cors extends BaseConfig
{
    // ...

    public array $api = [
        'allowedOrigins'         => ['http://10.241.132.47:8080'],
        'allowedOriginsPatterns' => [],
        'supportsCredentials'    => true,
        'allowedHeaders'         => ['Authorization', 'Content-Type'],
        'exposedHeaders'         => [],
        'allowedMethods'         => ['GET'],
        'maxAge'                 => 7200,
    ];
}


