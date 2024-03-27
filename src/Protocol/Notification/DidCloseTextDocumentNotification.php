<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\DidCloseTextDocumentParams;
use LSP\Protocol\Type\Method;

class DidCloseTextDocumentNotification extends Notification
{
    use Builder;

    public Method $method = Method::TEXTDOCUMENT_DIDCLOSE;
    public DidCloseTextDocumentParams $params;

    public function __construct(
        string $jsonrpc,

        Method $method,
        DidCloseTextDocumentParams $params,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc
        );

        $this->method = $method;
        $this->params = $params;
    }

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Closed: {$this->params->textDocument->uri}");

        $context->state->closeTextDocument($this->params);

        return null;
    }
}
