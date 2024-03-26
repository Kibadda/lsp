<?php

namespace LSP\Protocol\Request;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Response\ShutdownResponse;
use LSP\Protocol\Type\Method;

class ShutdownRequest extends Request
{
    use Builder;

    public Method $method = Method::SHUTDOWN;

    public function __construct(
        string $jsonrpc,
        int $id,

        Method $method,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc,
            id: $id,
        );

        $this->method = $method;
    }

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Prepare shutdown");

        $context->shouldExit = true;

        return new ShutdownResponse(
            id: $this->id,
            result: null,
        );
    }
}
