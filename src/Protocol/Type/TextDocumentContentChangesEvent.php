<?php

namespace LSP\Protocol\Type;

class TextDocumentContentChangesEvent
{
    public function __construct(
        public string $text,
    ) {
    }
}
