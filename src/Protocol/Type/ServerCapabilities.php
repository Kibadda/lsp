<?php

namespace LSP\Protocol\Type;

class ServerCapabilities
{
    public function __construct(
        public int $textDocumentSync,
        public CodeLensOptions $codeLensProvider,
        public ExecuteCommandOptions $executeCommandProvider,
    ) {
    }
}
