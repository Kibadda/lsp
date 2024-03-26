<?php

namespace LSP\Protocol\Notification;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\Method;

class ExitNotification extends Notification
{
    use Builder;

    public Method $method = Method::EXIT;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Exit");

        $context->exit = true;

        return null;
    }
}
