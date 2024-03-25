<?php

namespace LSP\Protocol\Response;

class TextDocumentDefinitionResponse extends Response
{
    public function __construct(
        int $id,
        public mixed $result,
    ){
        $this->id = $id;
    }
}
