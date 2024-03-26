<?php

namespace LSP\Protocol\Type;

abstract class Message
{
    public Method $method;

    public string $jsonrpc = '2.0';

    public function __construct(
        string $jsonrpc,
    ) {
        $this->jsonrpc = $jsonrpc;
    }
}
