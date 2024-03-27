<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class Range
{
    use Builder;

    public function __construct(
        public Position $start,
        public Position $end,
    ) {
    }
}
