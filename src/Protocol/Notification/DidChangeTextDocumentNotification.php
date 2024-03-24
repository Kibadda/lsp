<?php

namespace LSP\Protocol\Notification;

use LSP\Protocol\Type\DidChangeTextDocumentParams;
use LSP\Protocol\Type\Method;

class DidChangeTextDocumentNotification extends Notification
{
    public function __construct(
        public DidChangeTextDocumentParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_DIDCHANGE;
    }
}
