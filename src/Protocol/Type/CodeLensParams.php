<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class CodeLensParams
{
    use Builder;

    public TextDocumentIdentifier $textDocument;
}
