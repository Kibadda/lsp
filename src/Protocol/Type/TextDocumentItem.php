<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class TextDocumentItem
{
    use Builder;

    public function __construct(
        public string $uri,
        public string $languageId,
        public int $version,
        public string $text,
    ) {
    }
}
