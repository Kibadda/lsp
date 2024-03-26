<?php

namespace LSP;

use LSP\Protocol\Type\CodeLens;
use LSP\Protocol\Type\Command;
use LSP\Protocol\Type\Position;
use LSP\Protocol\Type\Range;
use stdClass;

class State
{
    /**
     * @param array<string, string> $textDocuments
     * @param array<string, CodeLens[]> $codeLenses
     * @param array<string, callable> $commands
     */
    public function __construct(
        private array $textDocuments = [],
        private array $codeLenses = [],
        private array $commands = [],
    ) {
        $this->commands = [
            'open_plugin_in_browser' => function (stdClass $arguments) {
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

    /**
     * @return ?CodeLens[]
     */
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
