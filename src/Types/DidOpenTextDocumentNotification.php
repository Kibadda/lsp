<?php

namespace ConfigLSP\Types;

class DidOpenTextDocumentNotification extends Notification
{
    public function __construct(
        public DidOpenTextDocumentParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_DIDOPEN;
    }
}
