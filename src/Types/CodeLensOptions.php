<?php

namespace ConfigLSP\Types;

class CodeLensOptions
{
    public function __construct(
        public bool $resolveProvider,
    ) {
    }
}
