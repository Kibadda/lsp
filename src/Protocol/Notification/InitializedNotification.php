<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\InitializedParams;

class InitializedNotification extends Notification
{
    use Builder;

    public InitializedParams $params;

    public function handle(Context $context): ?Response
    {
        $context->isInitialized = true;

        return null;
    }
}
