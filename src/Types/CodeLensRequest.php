<?php

namespace ConfigLSP\Types;

class CodeLensRequest extends Request
{
    public function __construct(
        public CodeLensParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_CODELENS;
    }
}
