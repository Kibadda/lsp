<?php

namespace ConfigLSP\Types;

class VersionedTextDocumentIdentifier extends TextDocumentIdentifier
{
    public function __construct(
        public int $version,
    ) {
    }
}
