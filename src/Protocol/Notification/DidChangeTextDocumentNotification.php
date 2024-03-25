<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\DidChangeTextDocumentParams;

class DidChangeTextDocumentNotification extends Notification
{
    use Builder;

    public DidChangeTextDocumentParams $params;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Changed: {$this->params->textDocument->uri}");

        foreach ($this->params->contentChanges as $change) {
            $context->state->changeTextDocument($this->params->textDocument->uri, $change->text);
        }

        return null;
    }
}
