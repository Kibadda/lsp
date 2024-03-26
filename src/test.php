<?php

use LSP\Protocol\Notification\DidChangeTextDocumentNotification;
use LSP\Protocol\Type\Method;

require_once __DIR__ . '/../vendor/autoload.php';

$object = (object) [
    'jsonrpc' => '2.0',
    'method' => Method::TEXTDOCUMENT_DIDCHANGE->value,
    'params' => (object) [
        'textDocument' => (object) [
            'uri' => 'file:///home/michael/.config/nvim/lua/user/config-lsp/init.lua',
            'version' => 3
        ],
        'contentChanges' => [
            (object) [
                'text' => 'test',
            ],
        ],
    ],
];

$test = DidChangeTextDocumentNotification::from($object);

print_r($test);
