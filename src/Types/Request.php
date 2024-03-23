<?php

namespace ConfigLSP\Types;

class Request extends Message
{
    public function __construct(
        public int $id,
        public string $method,
    ) {
    }
}
