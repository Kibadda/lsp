<?php

namespace LSP;

use LSP\Protocol\Type\CodeLens;
use LSP\Protocol\Type\Command;
use LSP\Protocol\Type\DidChangeTextDocumentParams;
use LSP\Protocol\Type\DidCloseTextDocumentParams;
use LSP\Protocol\Type\DidOpenTextDocumentParams;
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

    public function openTextDocument(DidOpenTextDocumentParams $params): void
    {
        $this->textDocuments[$params->textDocument->uri] = $params->textDocument->text;
        // $this->codeLenses[$params->textDocument->uri] = $this->calculateCodeLenses($uri, $contents);
    }

    public function changeTextDocument(DidChangeTextDocumentParams $params): void
    {
        $document = $this->textDocuments[$params->textDocument->uri];

        foreach ($params->contentChanges as $change) {
            $i = 0;
            $start = null;
            $end = null;

            if (empty($document[$i])) {
                $start = 0;
                $end = 0;
            } else {
                $line = 0;
                $character = 0;

                while (!empty($document[$i])) {
                    if (is_null($start) && $line == $change->range->start->line && $character == $change->range->start->character) {
                        $start = $i;
                    }

                    if (is_null($end) && $line == $change->range->end->line && $character == $change->range->end->character) {
                        $end = $i;
                    }

                    if ($document[$i] == "\n") {
                        $line++;
                        $character = 0;
                    } else {
                        $character++;
                    }

                    $i++;

                    if (!is_null($start) && !is_null($end)) {
                        break;
                    }
                }

                if (is_null($end)) {
                    $end = $i;
                }
            }

            if (!is_null($start) && !is_null($end)) {
                $document = substr($document, 0, $start) . $change->text . substr($document, $end);
            }
        }

        $this->textDocuments[$params->textDocument->uri] = $document;
        // $this->codeLenses[$uri] = $this->calculateCodeLenses($uri, $contents);
    }

    public function closeTextDocument(DidCloseTextDocumentParams $params): void
    {
        unset($this->textDocuments[$params->textDocument->uri]);
        unset($this->codeLenses[$params->textDocument->uri]);
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
