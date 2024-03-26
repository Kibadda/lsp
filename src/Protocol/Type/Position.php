<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class Position
{
    use Builder;

    public function __construct(
        public int $line,
        public int $character,
    ) {
    }
}
