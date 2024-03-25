<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;

class ExitNotification extends Notification
{
    use Builder;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Exit");

        $context->exit = true;

        return null;
    }
}
