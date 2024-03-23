<?php

namespace ConfigLSP;

use ConfigLSP\Types\DidChangeTextDocument;
use ConfigLSP\Types\DidCloseTextDocument;
use ConfigLSP\Types\DidOpenTextDocument;
use ConfigLSP\Types\InitializeRequest;
use ConfigLSP\Types\InitializeResponse;
use ConfigLSP\Types\InitializeResult;
use ConfigLSP\Types\Method;
use ConfigLSP\Types\Notification;
use ConfigLSP\Types\Request;
use ConfigLSP\Types\ServerCapabilities;
use ConfigLSP\Types\ServerInfo;

class Server
{
    public function __construct(
        private Logger $logger = new Logger(),
        private RPC $rpc = new RPC(),
        private State $state = new State(),
    ) {
    }

    public function run(): void
    {
        $this->logger->log('Started server');

        $data = '';

        while (true) {
            $data .= stream_get_contents(STDIN, 1);

            $result = $this->rpc->split($data);

            if ($result) {
                $data = substr($data, $result['length']);

                $message = $this->rpc->decode($result['data'], $error);

                if ($error) {
                    $this->logger->log($error);
                    continue;
                }

                $this->handleMessage($message);
            }
        }
    }

    /**
     * @param Request|Notification $message
     */
    private function handleMessage(object $message): void
    {
        $this->logger->log("Received msg with method: {$message->method}");

        $method = Method::tryFrom($message->method);

        $response = match ($method) {
            Method::INITIALIZE => $this->initialize($message),
            Method::TEXTDOCUMENT_DIDOPEN => $this->textDocumentDidOpen($message),
            Method::TEXTDOCUMENT_DIDCHANGE => $this->textDocumentDidChange($message),
            Method::TEXTDOCUMENT_DIDCLOSE => $this->textDocumentDidClose($message),
            default => null,
        };

        if ($response) {
            fwrite(STDOUT, $this->rpc->encode($response));
        }
    }

    /**
     * @param InitializeRequest $message
     */
    private function initialize(object $message): InitializeResponse
    {
        $this->logger->log("Connected to: {$message->params->clientInfo->name} {$message->params->clientInfo->version}");

        return new InitializeResponse(
            id: $message->id,
            result: new InitializeResult(
                capabilities: new ServerCapabilities(
                    textDocumentSync: 1,
                ),
                serverInfo: new ServerInfo(
                    name: 'configlsp',
                    version: '1.0',
                ),
            ),
        );
    }

    /**
     * @param DidOpenTextDocument $message
     */
    private function textDocumentDidOpen(object $message): void
    {
        $this->logger->log("Opened: {$message->params->textDocument->uri}");
        $this->state->openTextDocument($message->params->textDocument->uri, $message->params->textDocument->text);
    }

    /**
     * @param DidChangeTextDocument $message
     */
    private function textDocumentDidChange(object $message): void
    {
        $this->logger->log("Changed: {$message->params->textDocument->uri}");

        foreach ($message->params->contentChanges as $change) {
            $this->state->changeTextDocument($message->params->textDocument->uri, $change->text);
        }
    }

    /**
     * @param DidCloseTextDocument $message
     */
    private function textDocumentDidClose(object $message): void
    {
        $this->logger->log("Closed: {$message->params->textDocument->uri}");
        $this->state->closeTextDocument($message->params->textDocument->uri);
    }
}
