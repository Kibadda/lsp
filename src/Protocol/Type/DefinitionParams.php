<?php

namespace LSP\Protocol\Type;

class DefinitionParams
{
    public function __construct(
        public TextDocumentIdentifier $textDocument,
        public Position $position,
    ){}
}
