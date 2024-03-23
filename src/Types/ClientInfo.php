<?php

namespace ConfigLSP\Types;

class ClientInfo
{
    public function __construct(
        public string $name,
        public ?string $version,
    ) {
    }
}
