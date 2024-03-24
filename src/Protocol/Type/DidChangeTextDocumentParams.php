<?php

namespace LSP\Protocol\Type;

class DidChangeTextDocumentParams
{
    /** @var TextDocumentContentChangesEvent[] $contentChanges */
    public function __construct(
        public VersionedTextDocumentIdentifier $textDocument,
        public array $contentChanges,
    ) {
    }
}
