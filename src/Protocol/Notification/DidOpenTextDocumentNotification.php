<?php

namespace LSP\Protocol\Notification;

use LSP\Protocol\Type\DidOpenTextDocumentParams;
use LSP\Protocol\Type\Method;

class DidOpenTextDocumentNotification extends Notification
{
    public function __construct(
        public DidOpenTextDocumentParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_DIDOPEN;
    }
}
