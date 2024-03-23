<?php

namespace ConfigLSP\Types;

class DidOpenTextDocumentParams
{
    public function __construct(
        public TextDocumentItem $textDocument,
    ) {
    }
}
