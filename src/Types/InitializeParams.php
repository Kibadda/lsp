<?php

namespace ConfigLSP\Types;

class InitializeParams
{
    public function __construct(
        public ?ClientInfo $clientInfo,
    ) {
    }
}
