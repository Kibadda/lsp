<?php

namespace LSP\Protocol\Type;

class TextDocumentIdentifier
{
    public function __construct(
        public string $uri,
    ) {
    }
}
