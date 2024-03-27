<?php

namespace LSP\Protocol\Type;

class DidChangeTextDocumentParams
{
    /**
     * @param TextDocumentContentChangesEvent[] $contentChanges
     */
    public function __construct(
        public VersionedTextDocumentIdentifier $textDocument,
        public array $contentChanges,
    ) {
    }
}
