<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class Position
{
    use Builder;

    public int $line;
    public int $character;
}
