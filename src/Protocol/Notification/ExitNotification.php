<?php

namespace LSP\Protocol\Notification;

use LSP\Protocol\Type\Method;

class ExitNotification extends Notification
{
    public function __construct()
    {
        $this->method = Method::EXIT;
    }
}
