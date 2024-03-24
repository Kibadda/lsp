<?php

namespace LSP\Protocol\Type;

class InitializeResult
{
    public function __construct(
        public ServerCapabilities $capabilities,
        public ServerInfo $serverInfo,
    ) {
    }
}
