<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class DidChangeTextDocumentParams
{
    use Builder;

    public function __construct(
        public VersionedTextDocumentIdentifier $textDocument,
        /** @var TextDocumentContentChangesEvent[] */
        public array $contentChanges,
    ) {
    }
}
