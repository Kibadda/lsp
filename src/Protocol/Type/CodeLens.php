<?php

namespace LSP\Protocol\Type;

class CodeLens
{
    public function __construct(
        public Range $range,
        public Command $command,
    ) {
    }
}
