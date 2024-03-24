<?php

namespace LSP\Protocol\Request;

use LSP\Protocol\Type\ExecuteCommandParams;
use LSP\Protocol\Type\Method;

class ExecuteCommandRequest extends Request
{
    public function __construct(
        public ExecuteCommandParams $params,
    ) {
        $this->method = Method::WORKSPACE_EXECUTECOMMAND;
    }
}
