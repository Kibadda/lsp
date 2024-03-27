<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class TextDocumentContentChangesEvent
{
    use Builder;

    public function __construct(
        public Range $range,
        public string $text,
    ) {
    }
}
