<?php

namespace LSP\Protocol\Request;

use LSP\Builder;
use LSP\Context;
use LSP\Protocol\Response\CodeLensResponse;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\CodeLensParams;

class CodeLensRequest extends Request
{
    use Builder;

    public CodeLensParams $params;

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Requesting codelenses for: {$this->params->textDocument->uri}");

        return new CodeLensResponse(
            id: $this->id,
            result: $context->state->getCodeLenses($this->params->textDocument->uri),
        );
    }
}
