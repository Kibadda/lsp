<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Handler;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\DidOpenTextDocumentParams;

class DidOpenTextDocumentNotification extends Notification implements Handler
{
    use Builder;

    public DidOpenTextDocumentParams $params;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Opened: {$this->params->textDocument->uri}");

        $context->state->openTextDocument($this->params->textDocument->uri, $this->params->textDocument->text);

        return null;
    }
}
