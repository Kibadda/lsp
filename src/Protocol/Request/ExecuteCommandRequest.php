<?php

namespace LSP\Protocol\Request;

use LSP\Context;
use LSP\Protocol\Response\ExecuteCommandResponse;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\ExecuteCommandParams;
use LSP\Protocol\Type\Method;

class ExecuteCommandRequest extends Request
{
    public Method $method = Method::WORKSPACE_EXECUTECOMMAND;
    public ExecuteCommandParams $params;

    public function __construct(
        string $jsonrpc,
        int $id,

        Method $method,
        ExecuteCommandParams $params,
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
        $context->logger->log("Executing command: {$this->params->command}");

        $context->state->executeCommand($this->params->command, $this->params->arguments);

        return new ExecuteCommandResponse(
            id: $this->id,
            result: null,
        );
    }
}
