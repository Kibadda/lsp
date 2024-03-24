<?php

namespace LSP\Protocol\Notification;

use LSP\Protocol\Type\DidCloseTextDocumentParams;
use LSP\Protocol\Type\Method;

class DidCloseTextDocumentNotification extends Notification
{
    public function __construct(
        public DidCloseTextDocumentParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_DIDCLOSE;
    }
}
