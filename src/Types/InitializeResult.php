<?php

namespace ConfigLSP\Types;

class InitializeResult
{
    public function __construct(
        public ServerCapabilities $capabilities,
        public ServerInfo $serverInfo,
    ) {
    }
}
