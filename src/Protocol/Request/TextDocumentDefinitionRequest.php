<?php

namespace LSP\Protocol\Request;

use LSP\Protocol\Type\DefinitionParams;
use LSP\Protocol\Type\Method;

class TextDocumentDefinitionRequest extends Request
{
    public function __construct(
        public DefinitionParams $params,
    ){
        $this->method = Method::TEXTDOCUMENT_DEFINITION;
    }
}
