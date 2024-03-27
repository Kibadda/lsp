<?php

namespace LSP\Protocol\Type;

use LSP\Protocol\Notification\DidChangeTextDocumentNotification;
use LSP\Protocol\Notification\DidCloseTextDocumentNotification;
use LSP\Protocol\Notification\DidOpenTextDocumentNotification;
use LSP\Protocol\Notification\ExitNotification;
use LSP\Protocol\Notification\InitializedNotification;
use LSP\Protocol\Request\CodeLensRequest;
use LSP\Protocol\Request\ExecuteCommandRequest;
use LSP\Protocol\Request\InitializeRequest;
use LSP\Protocol\Request\ShutdownRequest;
use LSP\Protocol\Request\TextDocumentDefinitionRequest;

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

    public function class(): string
    {
        return match ($this) {
            Method::INITIALIZE => InitializeRequest::class,
            Method::INITIALIZED => InitializedNotification::class,
            Method::SHUTDOWN => ShutdownRequest::class,
            Method::EXIT => ExitNotification::class,

            Method::TEXTDOCUMENT_DIDOPEN => DidOpenTextDocumentNotification::class,
            Method::TEXTDOCUMENT_DIDCHANGE => DidChangeTextDocumentNotification::class,
            Method::TEXTDOCUMENT_DIDCLOSE => DidCloseTextDocumentNotification::class,

            Method::TEXTDOCUMENT_CODELENS => CodeLensRequest::class,
            Method::TEXTDOCUMENT_DEFINITION => TextDocumentDefinitionRequest::class,

            Method::WORKSPACE_EXECUTECOMMAND => ExecuteCommandRequest::class,
        };
    }
}
