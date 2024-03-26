<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class ClientInfo
{
    use Builder;

    public function __construct(
        public string $name,
        public ?string $version,
    ) {
    }
}
