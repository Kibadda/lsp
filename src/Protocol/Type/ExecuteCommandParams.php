<?php

namespace LSP\Protocol\Type;

class ExecuteCommandParams
{
    /**
     * @param ?mixed[] $arguments
     */
    public function __construct(
        public string $command,
        public ?array $arguments,
    ) {
    }
}
