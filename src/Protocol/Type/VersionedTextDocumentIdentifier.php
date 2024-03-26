<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class VersionedTextDocumentIdentifier extends TextDocumentIdentifier
{
    use Builder;

    public function __construct(
        public int $version,

        string $uri,
    ) {
        parent::__construct($uri);
    }
}
