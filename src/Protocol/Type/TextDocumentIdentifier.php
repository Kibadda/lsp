<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class TextDocumentIdentifier
{
    use Builder;

    public string $uri;
}
