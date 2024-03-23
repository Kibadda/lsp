<?php

namespace ConfigLSP;

use ConfigLSP\Types\Method;
use ConfigLSP\Types\Notification;
use ConfigLSP\Types\Request;

class Server
{
    private Logger $logger;

    public function __construct(
        private RPC $rpc = new RPC(),
    ) {
        $this->logger = Logger::get();
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

        if (!$method instanceof Method) {
            $this->logger->log("Unrecognized method: {$message->method}");
            return;
        }

        $response = $method->handle($message);

        if ($response) {
            fwrite(STDOUT, $this->rpc->encode($response));
        }
    }
}
