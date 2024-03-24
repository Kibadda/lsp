<?php

namespace LSP\Protocol\Type;

class CodeLensOptions
{
    public function __construct(
        public bool $resolveProvider,
    ) {
    }
}
