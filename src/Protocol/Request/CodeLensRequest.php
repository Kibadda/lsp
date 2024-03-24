<?php

namespace LSP\Protocol\Request;

use LSP\Protocol\Type\CodeLensParams;
use LSP\Protocol\Type\Method;

class CodeLensRequest extends Request
{
    public function __construct(
        public CodeLensParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_CODELENS;
    }
}
