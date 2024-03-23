<?php

namespace ConfigLSP\Types;

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
