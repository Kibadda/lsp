<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class ExecuteCommandParams
{
    use Builder;

    public string $command;
    public ?array $arguments;
}
