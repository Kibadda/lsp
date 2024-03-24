<?php

namespace LSP\Protocol\Type;

class DidOpenTextDocumentParams
{
    public function __construct(
        public TextDocumentItem $textDocument,
    ) {
    }
}
