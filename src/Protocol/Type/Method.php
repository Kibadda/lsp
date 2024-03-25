<?php

namespace LSP\Protocol\Type;

enum Method: string
{
    case INITIALIZE = 'initialize';
    case INITIALIZED = 'initialized';
    case SHUTDOWN = 'shutdown';
    case EXIT = 'exit';

    case TEXTDOCUMENT_DIDOPEN = 'textDocument/didOpen';
    case TEXTDOCUMENT_DIDCHANGE = 'textDocument/didChange';
    case TEXTDOCUMENT_DIDCLOSE = 'textDocument/didClose';

    case TEXTDOCUMENT_DEFINITION = 'textDocument/definition';
    case TEXTDOCUMENT_CODELENS = 'textDocument/codeLens';

    case WORKSPACE_EXECUTECOMMAND = 'workspace/executeCommand';
}
