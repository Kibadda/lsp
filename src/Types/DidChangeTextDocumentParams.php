<?php

namespace ConfigLSP\Types;

class DidChangeTextDocumentParams
{
    /** @var TextDocumentContentChangesEvent[] $contentChanges */
    public function __construct(
        public VersionedTextDocumentIdentifier $textDocument,
        public array $contentChanges,
    ) {
    }
}
