<?php

namespace LSP\Protocol\Type;

class Range
{
    public function __construct(
        public Position $start,
        public Position $end,
    ) {
    }
}
