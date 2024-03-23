<?php

namespace ConfigLSP;

use Exception;

class Logger
{
    public const ERROR = 'ERROR';
    public const INFO = 'INFO';

    private string $path;
    private $stream;

    public function __construct()
    {
        $this->path = __DIR__ . '/../log.txt';
        $this->stream = fopen($this->path, 'w');

        if ($this->stream === false) {
            throw new Exception('could not open log file');
        }
    }

    public function log(mixed $message, string $level = self::INFO): void
    {
        $date = date('Y-m-d H:i:s');


        if (!in_array(gettype($message), ['boolean', 'integer', 'double', 'string'])) {
            $message = json_encode($message, JSON_PRETTY_PRINT);
        }

        fwrite($this->stream, "[{$date}] [{$level}] {$message}\n");
    }

    public function __destruct()
    {
        if ($this->stream) {
            fclose($this->stream);
        }
    }
}
