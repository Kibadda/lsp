<?php

namespace LSP\Protocol\Type;

class InitializeParams
{
    public function __construct(
        public ?ClientInfo $clientInfo,
    ) {
    }
}
