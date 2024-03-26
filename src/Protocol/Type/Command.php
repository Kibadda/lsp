<?php

namespace LSP\Protocol\Type;

class Command
{
    /**
     * @param ?mixed[] $arguments
     */
    public function __construct(
        public string $title,
        public string $command,
        public ?array $arguments,
    ) {
    }
}
