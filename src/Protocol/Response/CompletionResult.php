<?php

namespace LSP\Protocol\Response;

use LSP\Protocol\Type\CompletionItem;

class CompletionResult extends Response
{
    /**
     * @param ?CompletionItem[] $result
     */
    public function __construct(
        int $id,

        public ?array $result,
    ) {
        $this->id = $id;
    }
}
