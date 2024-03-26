<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class DefinitionParams
{
    use Builder;

    public function __construct(
        public TextDocumentIdentifier $textDocument,
        public Position $position,
    ) {
    }
}
