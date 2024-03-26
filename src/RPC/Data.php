<?php

namespace LSP\RPC;

class Data
{
    public function __construct(
        public int $length,
        public string $data,
    ) {
    }
}
