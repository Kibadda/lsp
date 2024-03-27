<?php

namespace LSP;

use Exception;

class Logger
{
    public const ERROR = 'ERROR';
    public const INFO = 'INFO';

    private string $name;
    private string $path;
    private mixed $stream;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->path = __DIR__ . "/../{$this->name}.log";
        $this->stream = fopen($this->path, 'w');

        if (!is_resource($this->stream)) {
            throw new Exception('could not open log file');
        }
    }

    public function log(mixed $message, string $level = self::INFO): void
    {
        $date = date('Y-m-d H:i:s');

        $message = match (true) {
            is_string($message) => (string) $message,
            is_numeric($message) => (int) $message,
            is_bool($message) => (bool) $message,
            default => json_encode($message, JSON_PRETTY_PRINT),
        };

        if (!is_resource($this->stream)) {
            throw new Exception('could not open log file');
        }

        fwrite($this->stream, "[{$date}] [{$this->name}] [{$level}] {$message}\n");
    }

    public function __destruct()
    {
        if ($this->stream && is_resource($this->stream)) {
            fclose($this->stream);
        }
    }
}
