<?php

namespace LSP\RPC;

use AllowDynamicProperties;

#[AllowDynamicProperties]
class IncomingMessage
{
    public string $jsonrpc;
    public string $method;

    public static function from(object $data): self
    {
        $self = new self();

        foreach (get_object_vars($data) as $key => $value) {
            $self->$key = $value;
        }

        return $self;
    }
}
