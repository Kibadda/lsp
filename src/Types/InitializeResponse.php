<?php

namespace ConfigLSP\Types;

class InitializeResponse
{
    use Response;

    public function __construct(
        int $id,
        public InitializeResult $result,
    ) {
        $this->id = $id;
    }
}
