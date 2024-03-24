<?php

require_once __DIR__ . '/../vendor/autoload.php';

use LSP\Server;
use LSP\ServerName;

if ($argc != 2) {
    exit(1);
}

$name = ServerName::tryFrom($argv[1]);

if (!$name instanceof ServerName) {
    exit(1);
}

Server::build($name)->run();
