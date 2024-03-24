<?php

namespace LSP\Protocol\Type;

class DidCloseTextDocumentParams
{
    public function __construct(
        public TextDocumentIdentifier $textDocument,
    ) {
    }
}
