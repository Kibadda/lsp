<?php

namespace LSP;

use LSP\Protocol\Notification\Notification;
use LSP\Protocol\Request\Request;
use Exception;

class RPC
{
    public static function split(string $data): ?array
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

        return [
            'length' => $totalLength,
            'data' => substr($data, 0, $totalLength),
        ];
    }

    /**
     * @return Request|Notification|null
     */
    public static function decode(string $data, ?string &$error): mixed
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

        if (json_last_error() != JSON_ERROR_NONE) {
            $error = 'could not parse content';
            return null;
        }

        return $decoded;
    }

    public static function encode(object $response): string
    {
        $json = json_encode($response);
        $length = strlen($json);

        return "Content-Length: {$length}\r\n\r\n{$json}";
    }
}
