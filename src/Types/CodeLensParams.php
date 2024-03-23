<?php

namespace ConfigLSP\Types;

class CodeLensParams
{
    public function __construct(
        public TextDocumentIdentifier $textDocument,
    ) {
    }
}
