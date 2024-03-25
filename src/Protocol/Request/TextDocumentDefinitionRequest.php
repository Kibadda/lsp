<?php

namespace LSP\Protocol\Request;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Response\TextDocumentDefinitionResponse;
use LSP\Protocol\Type\DefinitionParams;

class TextDocumentDefinitionRequest extends Request
{
    use Builder;

    public DefinitionParams $params;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Requesting definition for: {$this->params->textDocument->uri}:{$this->params->position->line}:{$this->params->position->character}");

        return new TextDocumentDefinitionResponse(
            id: $this->id,
            result: null,
        );
    }
}
