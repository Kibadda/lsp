<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\DidOpenTextDocumentParams;
use LSP\Protocol\Type\Method;

class DidOpenTextDocumentNotification extends Notification
{
    use Builder;

    public Method $method = Method::TEXTDOCUMENT_DIDOPEN;
    public DidOpenTextDocumentParams $params;

    public function __construct(
        string $jsonrpc,

        Method $method,
        DidOpenTextDocumentParams $params,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc
        );

        $this->method = $method;
        $this->params = $params;
    }

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Opened: {$this->params->textDocument->uri}");

        $context->state->openTextDocument($this->params->textDocument->uri, $this->params->textDocument->text);

        return null;
    }
}
