<?php

namespace ConfigLSP;

class State
{
    /** @var array<string, string> $textDocuments */
    public function __construct(
        private array $textDocuments = [],
    ) {
    }

    public function openTextDocument(string $uri, string $contents): void
    {
        $this->textDocuments[$uri] = $contents;
    }

    public function changeTextDocument(string $uri, string $contents): void
    {
        $this->textDocuments[$uri] = $contents;
    }

    public function closeTextDocument(string $uri): void
    {
        unset($this->textDocuments[$uri]);
    }
}
