<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class DidChangeTextDocumentParams
{
    use Builder;


    /**
     * @param TextDocumentContentChangesEvent[] $contentChanges
     */
    public function __construct(
        public VersionedTextDocumentIdentifier $textDocument,
        public array $contentChanges,
    ) {
    }
}
