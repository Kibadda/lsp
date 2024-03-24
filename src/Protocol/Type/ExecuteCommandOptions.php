<?php

namespace LSP\Protocol\Type;

class ExecuteCommandOptions
{
    /** @var string[] $commands */
    public function __construct(
        public array $commands,
    ) {
    }
}
