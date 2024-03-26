<?php

namespace LSP\Protocol\Type;

class ExecuteCommandOptions
{
    /**
     * @param string[] $commands
     */
    public function __construct(
        public array $commands,
    ) {
    }
}
