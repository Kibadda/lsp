<?php

namespace ConfigLSP\Types;

class Message
{
    public function __construct(
        public string $jsonrpc = '2.0',
    ) {
    }
}
