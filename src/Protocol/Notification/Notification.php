<?php

namespace LSP\Protocol\Notification;

use LSP\Context;
use LSP\Handler;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\Message;

abstract class Notification extends Message implements Handler
{
    public string $method;

    abstract public function handle(Context $context): ?Response;
}
