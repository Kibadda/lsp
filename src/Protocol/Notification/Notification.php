<?php

namespace LSP\Protocol\Notification;

use LSP\Context;
use LSP\Handler;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\Message;
use LSP\Protocol\Type\Method;

abstract class Notification extends Message implements Handler
{
    public Method $method;

    abstract public function handle(Context $context): ?Response;
}
