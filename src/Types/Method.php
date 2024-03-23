<?php

namespace ConfigLSP\Types;

use ConfigLSP\Logger;
use ConfigLSP\State;

enum Method: string
{
    case INITIALIZE = 'initialize';
    case TEXTDOCUMENT_DIDOPEN = 'textDocument/didOpen';
    case TEXTDOCUMENT_DIDCHANGE = 'textDocument/didChange';
    case TEXTDOCUMENT_DIDCLOSE = 'textDocument/didClose';
    case TEXTDOCUMENT_CODELENS = 'textDocument/codeLens';
    case WORKSPACE_EXECUTECOMMAND = 'workspace/executeCommand';

    public function handle(object $message): ?Response
    {
        return match ($this) {
            self::INITIALIZE => $this->initialize($message),
            self::TEXTDOCUMENT_DIDOPEN => $this->textDocumentDidOpen($message),
            self::TEXTDOCUMENT_DIDCHANGE => $this->textDocumentDidChange($message),
            self::TEXTDOCUMENT_DIDCLOSE => $this->textDocumentDidClose($message),
            self::TEXTDOCUMENT_CODELENS => $this->textDocumentCodeLens($message),
            self::WORKSPACE_EXECUTECOMMAND => $this->workspaceExecuteCommand($message),
            default => null,
        };
    }

    /**
     * @param InitializeRequest $message
     */
    private function initialize(object $message): InitializeResponse
    {
        Logger::get()->log("Connected to: {$message->params->clientInfo->name} {$message->params->clientInfo->version}");

        return new InitializeResponse(
            id: $message->id,
            result: new InitializeResult(
                capabilities: new ServerCapabilities(
                    textDocumentSync: 1,
                    codeLensProvider: new CodeLensOptions(
                        resolveProvider: false,
                    ),
                    executeCommandProvider: new ExecuteCommandOptions(
                        commands: [
                            'open_plugin_in_browser',
                        ],
                    ),
                ),
                serverInfo: new ServerInfo(
                    name: 'configlsp',
                    version: '1.0',
                ),
            ),
        );
    }

    /**
     * @param DidOpenTextDocumentNotification $message
     */
    private function textDocumentDidOpen(object $message): void
    {
        Logger::get()->log("Opened: {$message->params->textDocument->uri}");
        State::get()->openTextDocument($message->params->textDocument->uri, $message->params->textDocument->text);
    }

    /**
     * @param DidChangeTextDocumentNotification $message
     */
    private function textDocumentDidChange(object $message): void
    {
        Logger::get()->log("Changed: {$message->params->textDocument->uri}");

        $state = State::get();
        foreach ($message->params->contentChanges as $change) {
            $state->changeTextDocument($message->params->textDocument->uri, $change->text);
        }
    }

    /**
     * @param DidCloseTextDocumentNotification $message
     */
    private function textDocumentDidClose(object $message): void
    {
        Logger::get()->log("Closed: {$message->params->textDocument->uri}");
        State::get()->closeTextDocument($message->params->textDocument->uri);
    }

    /**
     * @param CodeLensRequest $message
     */
    private function textDocumentCodeLens(object $message): CodeLensResponse
    {
        Logger::get()->log("Requesting codelenses for: {$message->params->textDocument->uri}");

        return new CodeLensResponse(
            id: $message->id,
            result: State::get()->getCodeLenses($message->params->textDocument->uri),
        );
    }

    /**
     * @param ExecuteCommandRequest $message
     */
    private function workspaceExecuteCommand(object $message): ExecuteCommandResponse
    {
        Logger::get()->log("Executing command: {$message->params->command}");

        State::get()->executeCommand($message->params->command, $message->params->arguments);

        return new ExecuteCommandResponse(
            id: $message->id,
            result: null,
        );
    }
}
