<?php

namespace ConfigLSP\Types;

class Response extends Message
{
    public function __construct(
        public ?int $id,
    ) {
    }
}
