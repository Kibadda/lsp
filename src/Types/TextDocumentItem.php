<?php

namespace ConfigLSP\Types;

trait TextDocumentItem
{
    public string $uri;
    public string $languageId;
    public int $version;
    public string $text;
}
