<?php

namespace LSP\Protocol\Type;

class VersionedTextDocumentIdentifier extends TextDocumentIdentifier
{
    public function __construct(
        public int $version,

        string $uri,
    ) {
        parent::__construct($uri);
    }
}
