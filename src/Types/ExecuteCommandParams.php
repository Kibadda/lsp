<?php

namespace ConfigLSP\Types;

class ExecuteCommandParams
{
    public function __construct(
        public string $command,
        public ?array $arguments,
    ) {
    }
}
