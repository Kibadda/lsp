<?php

namespace LSP;

use LSP\Protocol\Type\Method;
use LSP\Protocol\Type\ServerCapabilities;
use LSP\Protocol\Type\ServerInfo;
use LSP\RPC\IncomingMessage;
use LSP\RPC\RPC;

class Server
{
    public string $name;
    public Context $context;

    public static function build(ServerName $name): self
    {
        return new self(
            name: $name->value,
            capabilities: $name->capabilities(),
            serverInfo: new ServerInfo(
                name: $name->value,
                version: '1.0',
            ),
        );
    }

    public function __construct(string $name, ServerCapabilities $capabilities, ServerInfo $serverInfo)
    {
        $this->name = $name;
        $this->context = new Context($this->name, $capabilities, $serverInfo);
    }

    public function run(): void
    {
        $this->context->logger->log('Started');

        $data = '';

        while (true) {
            $data .= stream_get_contents(STDIN, 1);

            $result = RPC::split($data);

            if ($result) {
                $data = substr($data, $result->length);

                $message = RPC::decode($result->data, $error);

                if ($error || !$message) {
                    $this->context->logger->log($error);
                    continue;
                }

                $this->handle($message);

                if ($this->context->exit) {
                    exit($this->context->shouldExit ? 0 : 1);
                }
            }
        }
    }

    /**
     * @param IncomingMessage $message
     */
    private function handle(object $message): void
    {
        $this->context->logger->log("Received message: {$message->method}");
        $this->context->logger->log($message);

        $handler = Builder::build($message);

        if (empty($handler)) {
            $this->context->logger->log('Unrecognized method');

            return;
        }

        $response = $handler->handle($this->context);

        if ($response) {
            fwrite(STDOUT, RPC::encode($response));
        }
    }
}
