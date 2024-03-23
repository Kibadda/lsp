<?php

namespace ConfigLSP\Types;

class InitializeResponse extends Response
{
    public function __construct(
        int $id,
        public InitializeResult $result,
    ) {
        $this->id = $id;
    }
}
