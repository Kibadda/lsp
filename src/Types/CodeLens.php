<?php

namespace ConfigLSP\Types;

class CodeLens
{
    public function __construct(
        public Range $range,
        public Command $command,
    ) {
    }
}
