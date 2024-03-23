<?php

namespace ConfigLSP\Types;

trait DidChangeTextDocumentParams
{
    public VersionedTextDocumentIdentifier $textDocument;
    /** @var TextDocumentContentChangesEvent[] */
    public array $contentChanges;
}
