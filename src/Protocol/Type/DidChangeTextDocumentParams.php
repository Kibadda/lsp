<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class DidChangeTextDocumentParams
{
    use Builder;

    public VersionedTextDocumentIdentifier $textDocument;
    /** @var TextDocumentContentChangesEvent[] */
    public array $contentChanges;
}
