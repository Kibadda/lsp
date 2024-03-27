<?php

use LSP\Builder;
use LSP\Protocol\Type\Method;
use LSP\RPC\IncomingMessage;

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

$message = IncomingMessage::from($object);

$test = Builder::build($message);

print_r($test);
