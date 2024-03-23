<?php

namespace ConfigLSP\Types;

class Range
{
    public function __construct(
        public Position $start,
        public Position $end,
    ) {
    }
}
