<?php

namespace LSP\Protocol\Type;

class TextDocumentItem
{
    public function __construct(
        public string $uri,
        public string $languageId,
        public int $version,
        public string $text,
    ) {
    }
}
