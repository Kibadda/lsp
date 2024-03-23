<?php

namespace ConfigLSP\Types;

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
