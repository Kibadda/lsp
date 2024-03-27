<?php

namespace LSP\Protocol\Request;

use LSP\Context;
use LSP\Protocol\Response\CodeLensResponse;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\CodeLensParams;
use LSP\Protocol\Type\Method;

class CodeLensRequest extends Request
{
    public Method $method = Method::TEXTDOCUMENT_CODELENS;
    public CodeLensParams $params;

    public function __construct(
        string $jsonrpc,
        int $id,

        Method $method,
        CodeLensParams $params,
    ) {
        parent::__construct(
            jsonrpc: $jsonrpc,
            id: $id,
        );

        $this->method = $method;
        $this->params = $params;
    }

    public function handle(Context $context): ?Response
    {
        $context->logger->log("Requesting codelenses for: {$this->params->textDocument->uri}");

        return new CodeLensResponse(
            id: $this->id,
            result: $context->state->getCodeLenses($this->params->textDocument->uri),
        );
    }
}
