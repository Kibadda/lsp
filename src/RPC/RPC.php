<?php

namespace LSP\RPC;

use Exception;

class RPC
{
    public static function split(string $data): ?Data
    {
        $split = preg_split('/\r\n\r\n/', $data);

        if ($split === false || count($split) < 2) {
            return null;
        }

        list($header, $content) = $split;

        $contentLength = intval(substr($header, strlen('Content-Length ')));

        if (!$contentLength) {
            throw new Exception('content-length must be an integer');
        }

        if (strlen($content) < $contentLength) {
            return null;
        }

        $totalLength = strlen($header) + 4 + $contentLength;

        return new Data(
            length: $totalLength,
            data: substr($data, 0, $totalLength),
        );
    }

    /**
     * @return ?IncomingMessage
     */
    public static function decode(string $data, ?string &$error): ?IncomingMessage
    {
        $error = null;

        $split = preg_split('/\r\n\r\n/', $data);

        if ($split === false || count($split) != 2) {
            $error = 'did not find separator';
            return null;
        }

        list($header, $content) = $split;

        $contentLength = intval(substr($header, strlen('Content-Length ')));

        if (!$contentLength) {
            $error = 'Content-Length must be an integer';
            return null;
        }

        $decoded = json_decode($content);

        if (json_last_error() != JSON_ERROR_NONE || !is_object($decoded)) {
            $error = 'could not parse content';
            return null;
        }

        return IncomingMessage::from($decoded);
    }

    public static function encode(object $response): string
    {
        $json = json_encode($response);

        if ($json === false) {
            throw new Exception('could not encode message');
        }

        $length = strlen($json);

        return "Content-Length: {$length}\r\n\r\n{$json}";
    }
}
