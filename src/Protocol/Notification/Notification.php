<?php

namespace LSP\Protocol\Notification;

use LSP\Protocol\Type\Message;

class Notification extends Message
{
    public function __construct(
        public string $method,
    ) {
    }
}
