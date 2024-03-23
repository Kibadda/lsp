<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConfigLSP\Server;

$server = new Server();
$server->run();
