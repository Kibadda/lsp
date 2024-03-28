<?php

namespace LSP\Protocol\Request;

use LSP\Context;
use LSP\Protocol\Response\CompletionResult;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Type\CompletionItem;
use LSP\Protocol\Type\CompletionParams;
use LSP\Protocol\Type\Method;

class CompletionRequest extends Request
{
    public Method $method = Method::TEXTDOCUMENT_COMPLETION;
    public CompletionParams $params;

    public function __construct(
        string $jsonrpc,
        int $id,

        Method $method,
        CompletionParams $params,
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
        $context->logger->log("completion");

        $completions = [];

        if (preg_match('/.*user\/plugins\/.*/', $this->params->textDocument->uri)) {
            $completions = array_merge($completions, [
                CompletionItem::snippet('plugin', "return {\n\t\"\$1\",\n\t\$0\n}"),
                CompletionItem::snippet('dependencies', "dependencies = {\n\t\$0\n},"),
                CompletionItem::snippet('init', "init = function(\$1)\n\t\$0\nend"),
                CompletionItem::snippet('config', "config = function(\${1:_, opts})\n\t\$0\nend"),
            ]);
        }

        return new CompletionResult(
            id: $this->id,
            result: $completions,
        );
    }
}
