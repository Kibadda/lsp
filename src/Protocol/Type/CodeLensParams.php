<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class CodeLensParams
{
    use Builder;

    public function __construct(
        public TextDocumentIdentifier $textDocument,
    ) {
    }
}
