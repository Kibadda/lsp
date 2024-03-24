<?php

namespace LSP\Protocol\Response;

use LSP\Protocol\Type\Message;

class Response extends Message
{
    public function __construct(
        public ?int $id,
    ) {
    }
}
