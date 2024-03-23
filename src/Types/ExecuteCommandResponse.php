<?php

namespace ConfigLSP\Types;

class ExecuteCommandResponse extends Response
{
    public function __construct(
        int $id,
        public mixed $result,
    ) {
        $this->id = $id;
    }
}
