<?php

namespace LSP\Protocol\Response;

class CodeLensResponse extends Response
{
    /** @var ?CodeLens[] $result */
    public function __construct(
        int $id,
        public ?array $result,
    ) {
        $this->id = $id;
    }
}
