<?php

namespace LSP\Protocol\Request;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\ExecuteCommandResponse;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\ExecuteCommandParams;

class ExecuteCommandRequest extends Request
{
    use Builder;

    public ExecuteCommandParams $params;

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
