<?php

namespace LSP\Protocol\Type;

class ClientInfo
{
    public function __construct(
        public string $name,
        public ?string $version,
    ) {
    }
}
