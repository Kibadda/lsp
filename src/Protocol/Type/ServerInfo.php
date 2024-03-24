<?php

namespace LSP\Protocol\Type;

class ServerInfo
{
    public function __construct(
        public string $name,
        public string $version,
    ) {
    }
}
