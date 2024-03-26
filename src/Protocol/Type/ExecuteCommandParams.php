<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class ExecuteCommandParams
{
    use Builder;

    /**
     * @param ?mixed[] $arguments
     */
    public function __construct(
        public string $command,
        public ?array $arguments,
    ) {
    }
}
