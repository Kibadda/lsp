<?php

namespace LSP\Protocol\Response;

use LSP\Protocol\Type\InitializeResult;

class InitializeResponse extends Response
{
    public function __construct(
        int $id,
        public InitializeResult $result,
    ) {
        $this->id = $id;
    }
}
