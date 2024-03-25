<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\DidCloseTextDocumentParams;

class DidCloseTextDocumentNotification extends Notification
{
    use Builder;

    public DidCloseTextDocumentParams $params;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Closed: {$this->params->textDocument->uri}");

        $context->state->closeTextDocument($this->params->textDocument->uri);

        return null;
    }
}
