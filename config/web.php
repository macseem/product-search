<?php
return [
    'formatter' => 'json',
    'cacher' => [
        'type' => 'memcached',
        'serializer' => 'standard'
    ],
    'memcached' => [
        'host' => 'memcached',
        'port' => 11211
    ],
    'searcher' => [
        'type' => 'elasticSearch', // can be mysql
    ],
    'elasticSearch' => [
        'someElasticConfig'
    ],
    'mysql' => [
        'someMysqlConfig'
    ]
];