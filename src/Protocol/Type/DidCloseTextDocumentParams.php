<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class DidCloseTextDocumentParams
{
    use Builder;

    public TextDocumentIdentifier $textDocument;
}
