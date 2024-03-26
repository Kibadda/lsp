<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class InitializeParams
{
    use Builder;

    public function __construct(
        public ?ClientInfo $clientInfo,
    ) {
    }
}
