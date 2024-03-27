<?php

namespace LSP\Protocol\Request;

use LSP\Context;
use LSP\Protocol\Response\InitializeResponse;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\InitializeParams;
use LSP\Protocol\Type\InitializeResult;
use LSP\Protocol\Type\Method;

class InitializeRequest extends Request
{
    public Method $method = Method::INITIALIZE;
    public InitializeParams $params;

    public function __construct(
        string $jsonrpc,
        int $id,

        Method $method,
        InitializeParams $params,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc,
            id: $id,
        );

        $this->method = $method;
        $this->params = $params;
    }

    public function handle(Context $context): ?Response
    {
        if ($this->params->clientInfo) {
            if ($this->params->clientInfo->version) {
                $context->logger->log("Connected to {$this->params->clientInfo->name} with version {$this->params->clientInfo->version}");
            } else {
                $context->logger->log("Connected to {$this->params->clientInfo->name}");
            }
        } else {
            $context->logger->log('Connected');
        }

        return new InitializeResponse(
            id: $this->id,
            result: new InitializeResult(
                capabilities: $context->capabilities,
                serverInfo: $context->serverInfo,
            ),
        );
    }
}
