<?php

namespace ConfigLSP\Types;

class ServerInfo
{
    public function __construct(
        public string $name,
        public string $version,
    ) {
    }
}
