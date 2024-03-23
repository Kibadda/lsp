<?php

namespace ConfigLSP\Types;

class Notification extends Message
{
    public function __construct(
        public string $method,
    ) {
    }
}
