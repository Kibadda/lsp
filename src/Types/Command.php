<?php

namespace ConfigLSP\Types;

class Command
{
    public function __construct(
        public string $title,
        public string $command,
        public ?array $arguments,
    ) {
    }
}
