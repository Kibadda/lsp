<?php

namespace LSP;

use LSP\Protocol\Type\ServerCapabilities;
use LSP\Protocol\Type\ServerInfo;
use LSP\State;

class Context
{
    public Logger $logger;
    public State $state;

    public ServerCapabilities $capabilities;
    public ServerInfo $serverInfo;

    public bool $isInitialized;
    public bool $shouldExit;
    public bool $exit;

    public function __construct(string $name, ServerCapabilities $capabilities, ServerInfo $serverInfo)
    {
        $this->logger = new Logger($name);
        $this->state = new State();

        $this->capabilities = $capabilities;
        $this->serverInfo = $serverInfo;

        $this->shouldExit = false;
        $this->exit = false;
    }
}
