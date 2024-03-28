<?php

namespace LSP\Protocol\Type;

class TextDocumentPositionParams
{
    public function __construct(
        public TextDocumentIdentifier $textDocument,
        public Position $position,
    ) {
    }
}
