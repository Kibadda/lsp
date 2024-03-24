<?php

namespace LSP\Protocol\Type;

class ExecuteCommandParams
{
    public function __construct(
        public string $command,
        public ?array $arguments,
    ) {
    }
}
