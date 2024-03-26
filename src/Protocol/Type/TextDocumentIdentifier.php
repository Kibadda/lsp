<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class TextDocumentIdentifier
{
    use Builder;

    public function __construct(
        public string $uri,
    ) {
    }
}
