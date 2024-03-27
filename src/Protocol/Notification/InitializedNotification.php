<?php

namespace LSP\Protocol\Notification;

use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\InitializedParams;
use LSP\Protocol\Type\Method;

class InitializedNotification extends Notification
{
    public Method $method = Method::INITIALIZED;
    public InitializedParams $params;

    public function __construct(
        string $jsonrpc,

        Method $method,
        InitializedParams $params,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc
        );

        $this->method = $method;
        $this->params = $params;
    }

    public function handle(Context $context): ?Response
    {
        $context->isInitialized = true;

        return null;
    }
}
