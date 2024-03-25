<?php

namespace LSP\Protocol\Request;

use LSP\Context;
use LSP\Handler;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\Message;

abstract class Request extends Message implements Handler
{
    public int $id;
    public string $method;

    abstract public function handle(Context $context): ?Response;
}
