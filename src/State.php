<?php

namespace ConfigLSP;

use ConfigLSP\Types\CodeLens;
use ConfigLSP\Types\Command;
use ConfigLSP\Types\Position;
use ConfigLSP\Types\Range;

class State
{
    private static self $instance;

    public static function get(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /** @var array<string, string> $textDocuments */
    /** @var array<string, CodeLens[]> $codeLenses */
    /** @var array<string, callable> $commands */
    private function __construct(
        private array $textDocuments = [],
        private array $codeLenses = [],
        private array $commands = [],
    ) {

        $this->commands = [
            'open_plugin_in_browser' => function (object $arguments) {
                exec("xdg-open https://github.com/{$arguments->text}");
            }
        ];
    }

    public function openTextDocument(string $uri, string $contents): void
    {
        $this->textDocuments[$uri] = $contents;
        $this->codeLenses[$uri] = $this->calculateCodeLenses($uri, $contents);
    }

    public function changeTextDocument(string $uri, string $contents): void
    {
        $this->textDocuments[$uri] = $contents;
        $this->codeLenses[$uri] = $this->calculateCodeLenses($uri, $contents);
    }

    public function closeTextDocument(string $uri): void
    {
        unset($this->textDocuments[$uri]);
        unset($this->codeLenses[$uri]);
    }

    public function getCodeLenses(string $uri): ?array
    {
        if (!empty($this->codeLenses[$uri])) {
            return $this->codeLenses[$uri];
        }

        return null;
    }

    /**
     * @return CodeLens[]
     */
    private function calculateCodeLenses(string $uri, string $contents): array
    {
        if (!preg_match('/.*\/\.config\/nvim\/lua\/user\/plugins\/.*/', $uri)) {
            return [];
        }

        $codeLenses = [];

        $codeLenses[] = new CodeLens(
            range: new Range(
                start: new Position(
                    line: 0,
                    character: 0,
                ),
                end: new Position(
                    line: 0,
                    character: 1,
                ),
            ),
            command: new Command(
                title: 'open plugin',
                command: 'open_plugin_in_browser',
                arguments: [
                    'text' => 'Kibadda/configlsp',
                ],
            ),
        );

        return $codeLenses;
    }

    public function executeCommand(string $command, mixed $arguments): void
    {
        if (empty($this->commands[$command])) {
            return;
        }

        $this->commands[$command]($arguments);
    }
}
