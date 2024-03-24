<?php

namespace LSP\Protocol\Request;

use LSP\Protocol\Type\Message;

class Request extends Message
{
    public function __construct(
        public int $id,
        public string $method,
    ) {
    }
}
