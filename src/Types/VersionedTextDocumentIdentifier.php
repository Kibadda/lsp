<?php

namespace ConfigLSP\Types;

trait VersionedTextDocumentIdentifier
{
    use TextDocumentIdentifier;

    public int $version;
}
