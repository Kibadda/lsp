<?php

namespace LSP\Protocol\Type;

class CompletionItem
{
    public function __construct(
        public string $label,
        public ?int $kind,
        public ?string $detail,
        public ?string $insertText,
        public ?int $insertTextFormat,
    ) {
    }

    public static function snippet(string $label, string $snippet, ?string $detail = null): self
    {
        return new self(
            label: $label,
            insertText: $snippet,
            detail: $detail,
            kind: 15,
            insertTextFormat: 2,
        );
    }
}
