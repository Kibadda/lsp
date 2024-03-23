<?php

namespace ConfigLSP\Types;

class ServerCapabilities
{
    public function __construct(
        public int $textDocumentSync,
    ) {
    }
}
