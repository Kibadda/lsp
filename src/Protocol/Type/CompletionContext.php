<?php

namespace LSP\Protocol\Type;

class CompletionContext
{
    public function __construct(
        public int $triggerKind,
        public ?string $triggerCharacter = null,
    ) {
    }
}
