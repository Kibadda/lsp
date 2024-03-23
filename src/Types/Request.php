<?php

namespace ConfigLSP\Types;

trait Request
{
    use Message;

    public int $id;
    public string $method;
}
