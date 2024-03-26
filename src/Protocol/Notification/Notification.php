<?php

namespace LSP\Protocol\Notification;

use LSP\Context;
use LSP\Handler;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\Message;

abstract class Notification extends Message implements Handler
{
    public function __construct(
        string $jsonrpc,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc,
        );
    }

    abstract public function handle(Context $context): ?Response;
}
