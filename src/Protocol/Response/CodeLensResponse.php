<?php

namespace LSP\Protocol\Response;

use LSP\Protocol\Type\CodeLens;

class CodeLensResponse extends Response
{
    /**
     * @param ?CodeLens[] $result
     */
    public function __construct(
        int $id,
        public ?array $result,
    ) {
        $this->id = $id;
    }
}
