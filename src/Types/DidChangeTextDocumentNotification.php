<?php

namespace ConfigLSP\Types;

class DidChangeTextDocumentNotification extends Notification
{
    public function __construct(
        public DidChangeTextDocumentParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_DIDCHANGE;
    }
}
