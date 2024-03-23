<?php

namespace ConfigLSP\Types;

trait DidChangeTextDocument
{
    use Notification;

    public DidChangeTextDocumentParams $params;
}
