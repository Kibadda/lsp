<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\InitializedParams;
use LSP\Protocol\Type\Method;

class InitializedNotification extends Notification
{
    use Builder;

    public Method $method = Method::INITIALIZED;
    public InitializedParams $params;

    public function handle(Context $context): ?Response
    {
        $context->isInitialized = true;

        return null;
    }
}
