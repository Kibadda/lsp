<?php

namespace LSP\Protocol\Type;

use LSP\Builder;

class ClientInfo
{
    use Builder;

    public string $name;
    public ?string $version;
}
