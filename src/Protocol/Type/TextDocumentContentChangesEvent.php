<?php

namespace LSP\Protocol\Type;

class TextDocumentContentChangesEvent
{
    public function __construct(
        public Range $range,
        public string $text,
    ) {
    }
}
