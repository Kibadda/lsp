<?php

namespace ConfigLSP\Types;

class ExecuteCommandRequest extends Request
{
    public function __construct(
        public ExecuteCommandParams $params,
    ) {
        $this->method = Method::WORKSPACE_EXECUTECOMMAND;
    }
}
