<?php

use LSP\Protocol\Request\InitializeRequest;
use LSP\Protocol\Type\Method;

require_once __DIR__ . '/../vendor/autoload.php';

$object = (object) [
    'jsonrpc' => '2.0',
    'id' => 1,
    'method' => Method::INITIALIZE->value,
    'params' => (object) [
        'clientInfo' => (object) [
            'name' => 'nvim',
            'version' => '1.0',
        ],
    ],
];

$test = InitializeRequest::from($object);

print_r($test);
