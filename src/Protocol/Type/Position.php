<?php

namespace LSP\Protocol\Type;

class Position
{
    public function __construct(
        public int $line,
        public int $character,
    ) {
    }
}
