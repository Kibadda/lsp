<?php

namespace LSP\Protocol\Notification;

use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\DidChangeTextDocumentParams;
use LSP\Protocol\Type\Method;

class DidChangeTextDocumentNotification extends Notification
{
    public Method $method = Method::TEXTDOCUMENT_DIDCHANGE;
    public DidChangeTextDocumentParams $params;

    public function __construct(
        string $jsonrpc,

        Method $method,
        DidChangeTextDocumentParams $params,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc
        );

        $this->method = $method;
        $this->params = $params;
    }

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Changed: {$this->params->textDocument->uri}");

        $context->state->changeTextDocument($this->params);

        return null;
    }
}
