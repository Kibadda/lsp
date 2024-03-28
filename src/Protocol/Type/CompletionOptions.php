<?php

namespace LSP\Protocol\Type;

class CompletionOptions
{
    /**
     * @param null|string[] $triggerCharacters
     * @param null|string[] $allCommitCharacters
     */
    public function __construct(
        public ?array $triggerCharacters,
        public ?array $allCommitCharacters,
        public bool $resolveProvider,
    ) {
    }
}
