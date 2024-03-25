<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class VersionedTextDocumentIdentifier extends TextDocumentIdentifier
{
    use Builder;

    public int $version;
}
