<?php

namespace ConfigLSP\Types;

class TextDocumentIdentifier
{
    public function __construct(
        public string $uri,
    ) {
    }
}
