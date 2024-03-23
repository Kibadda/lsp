<?php

namespace ConfigLSP\Types;

class DidCloseTextDocumentParams
{
    public function __construct(
        public TextDocumentIdentifier $textDocument,
    ) {
    }
}
