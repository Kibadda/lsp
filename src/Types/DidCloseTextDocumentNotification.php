<?php

namespace ConfigLSP\Types;

class DidCloseTextDocumentNotification extends Notification
{
    public function __construct(
        public DidCloseTextDocumentParams $params,
    ) {
        $this->method = Method::TEXTDOCUMENT_DIDCLOSE;
    }
}
