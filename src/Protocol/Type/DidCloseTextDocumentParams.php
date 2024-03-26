<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class DidCloseTextDocumentParams
{
    use Builder;

    public function __construct(
        public TextDocumentIdentifier $textDocument,
    ) {
    }
}
