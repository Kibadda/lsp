<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class DidOpenTextDocumentParams
{
    use Builder;

    public function __construct(
        public TextDocumentItem $textDocument,
    ) {
    }
}
