<?php

namespace ConfigLSP\Types;

class TextDocumentContentChangesEvent
{
    public function __construct(
        public string $text,
    ) {
    }
}
