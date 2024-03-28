<?php

namespace LSP\Protocol\Type;

class CompletionParams extends TextDocumentPositionParams
{
    public function __construct(
        public ?CompletionContext $context,

        TextDocumentIdentifier $textDocument,
        Position $position,
    ) {
        parent::__construct(
            textDocument: $textDocument,
            position: $position,
        );
    }
}
