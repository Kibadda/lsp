<?php

namespace LSP\Protocol\Request;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\InitializeResponse;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\InitializeParams;
use LSP\Protocol\Type\InitializeResult;

class InitializeRequest extends Request
{
    use Builder;

    public InitializeParams $params;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Connected to: {$this->params->clientInfo->name} {$this->params->clientInfo->version}");

        return new InitializeResponse(
            id: $this->id,
            result: new InitializeResult(
                capabilities: $context->capabilities,
                serverInfo: $context->serverInfo,
            ),
        );
    }
}
