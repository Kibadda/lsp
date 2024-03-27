<?php

namespace LSP\Protocol\Type;

class CodeLensParams
{
    public function __construct(
        public TextDocumentIdentifier $textDocument,
    ) {
    }
}
