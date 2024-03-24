<?php

namespace LSP\Protocol\Type;

class Message
{
    public function __construct(
        public string $jsonrpc = '2.0',
    ) {
    }
}
