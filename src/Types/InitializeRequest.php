<?php

namespace ConfigLSP\Types;

class InitializeRequest extends Request
{
    public function __construct(
        public InitializeParams $params,
    ) {
        $this->method = Method::INITIALIZE;
    }
}
