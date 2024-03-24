<?php

namespace LSP\Protocol\Type;

use LSP\Context;
use LSP\Protocol\Notification\DidChangeTextDocumentNotification;
use LSP\Protocol\Notification\DidCloseTextDocumentNotification;
use LSP\Protocol\Notification\DidOpenTextDocumentNotification;
use LSP\Protocol\Notification\ExitNotification;
use LSP\Protocol\Request\CodeLensRequest;
use LSP\Protocol\Request\ExecuteCommandRequest;
use LSP\Protocol\Request\InitializeRequest;
use LSP\Protocol\Request\ShutdownRequest;
use LSP\Protocol\Response\CodeLensResponse;
use LSP\Protocol\Response\ExecuteCommandResponse;
use LSP\Protocol\Response\InitializeResponse;
use LSP\Protocol\Response\Response;
use LSP\Protocol\Response\ShutdownResponse;

enum Method: string
{
    case INITIALIZE = 'initialize';
    case TEXTDOCUMENT_DIDOPEN = 'textDocument/didOpen';
    case TEXTDOCUMENT_DIDCHANGE = 'textDocument/didChange';
    case TEXTDOCUMENT_DIDCLOSE = 'textDocument/didClose';
    case TEXTDOCUMENT_CODELENS = 'textDocument/codeLens';
    case WORKSPACE_EXECUTECOMMAND = 'workspace/executeCommand';
    case SHUTDOWN = 'shutdown';
    case EXIT = 'exit';

    public function handle(object $message, Context $context): ?Response
    {
        return match ($this) {
            self::INITIALIZE => $this->initialize($message, $context),
            self::TEXTDOCUMENT_DIDOPEN => $this->textDocumentDidOpen($message, $context),
            self::TEXTDOCUMENT_DIDCHANGE => $this->textDocumentDidChange($message, $context),
            self::TEXTDOCUMENT_DIDCLOSE => $this->textDocumentDidClose($message, $context),
            self::TEXTDOCUMENT_CODELENS => $this->textDocumentCodeLens($message, $context),
            self::WORKSPACE_EXECUTECOMMAND => $this->workspaceExecuteCommand($message, $context),
            self::SHUTDOWN => $this->shutdown($message, $context),
            self::EXIT => $this->exit($message, $context),
            default => null,
        };
    }

    /**
     * @param InitializeRequest $message
     */
    private function initialize(object $message, Context $context): InitializeResponse
    {
        $context->logger->log("Connected to: {$message->params->clientInfo->name} {$message->params->clientInfo->version}");

        return new InitializeResponse(
            id: $message->id,
            result: new InitializeResult(
                capabilities: $context->capabilities,
                serverInfo: $context->serverInfo,
            ),
        );
    }

    /**
     * @param DidOpenTextDocumentNotification $message
     */
    private function textDocumentDidOpen(object $message, Context $context): void
    {
        $context->logger->log("Opened: {$message->params->textDocument->uri}");
        $context->state->openTextDocument($message->params->textDocument->uri, $message->params->textDocument->text);
    }

    /**
     * @param DidChangeTextDocumentNotification $message
     */
    private function textDocumentDidChange(object $message, Context $context): void
    {
        $context->logger->log("Changed: {$message->params->textDocument->uri}");

        foreach ($message->params->contentChanges as $change) {
            $context->state->changeTextDocument($message->params->textDocument->uri, $change->text);
        }
    }

    /**
     * @param DidCloseTextDocumentNotification $message
     */
    private function textDocumentDidClose(object $message, Context $context): void
    {
        $context->logger->log("Closed: {$message->params->textDocument->uri}");
        $context->state->closeTextDocument($message->params->textDocument->uri);
    }

    /**
     * @param CodeLensRequest $message
     */
    private function textDocumentCodeLens(object $message, Context $context): CodeLensResponse
    {
        $context->logger->log("Requesting codelenses for: {$message->params->textDocument->uri}");

        return new CodeLensResponse(
            id: $message->id,
            result: $context->state->getCodeLenses($message->params->textDocument->uri),
        );
    }

    /**
     * @param ExecuteCommandRequest $message
     */
    private function workspaceExecuteCommand(object $message, Context $context): ExecuteCommandResponse
    {
        $context->logger->log("Executing command: {$message->params->command}");

        $context->state->executeCommand($message->params->command, $message->params->arguments);

        return new ExecuteCommandResponse(
            id: $message->id,
            result: null,
        );
    }

    /**
     * @param ShutdownRequest $message
     */
    private function shutdown(object $message, Context $context): ShutdownResponse
    {
        $context->logger->log("Prepare shutdown");

        $context->shouldExit = true;

        return new ShutdownResponse(
            id: $message->id,
            result: null,
        );
    }

    /**
     * @param ExitNotification $message
     */
    private function exit(object $message, Context $context): void
    {
        $context->logger->log("Exit");

        $context->exit = true;
    }
}
