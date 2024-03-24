<?php

namespace LSP\Protocol\Request;

use LSP\Protocol\Type\Method;

class ShutdownRequest extends Request
{
    public function __construct()
    {
        $this->method = Method::SHUTDOWN;
    }
}
