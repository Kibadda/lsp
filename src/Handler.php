<?php

namespace LSP;

use LSP\Protocol\Response\Response;

interface Handler
{
    public function handle(Context $context): ?Response;
}
