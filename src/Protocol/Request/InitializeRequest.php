<?php

namespace LSP\Protocol\Request;

use LSP\Protocol\Type\InitializeParams;
use LSP\Protocol\Type\Method;

class InitializeRequest extends Request
{
    public function __construct(
        public InitializeParams $params,
    ) {
        $this->method = Method::INITIALIZE;
    }
}
