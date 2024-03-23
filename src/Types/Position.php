<?php

namespace ConfigLSP\Types;

class Position
{
    public function __construct(
        public int $line,
        public int $character,
    ) {
    }
}
