<?php

namespace ConfigLSP\Types;

class ExecuteCommandOptions
{
    /** @var string[] $commands */
    public function __construct(
        public array $commands,
    ) {
    }
}
