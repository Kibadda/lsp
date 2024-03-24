<?php

namespace LSP;

use LSP\Protocol\Type\CodeLensOptions;
use LSP\Protocol\Type\ExecuteCommandOptions;
use LSP\Protocol\Type\ServerCapabilities;

enum ServerName: string
{
    case CONFIG = 'configlsp';

    public function capabilities(): ServerCapabilities
    {
        return match ($this) {
            self::CONFIG => new ServerCapabilities(
                textDocumentSync: 1,
                codeLensProvider: new CodeLensOptions(
                    resolveProvider: false,
                ),
                executeCommandProvider: new ExecuteCommandOptions(
                    commands: ['open_plugin_in_browser'],
                ),
            ),
        };
    }
}
