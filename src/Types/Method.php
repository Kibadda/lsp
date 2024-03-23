<?php

namespace ConfigLSP\Types;

enum Method: string
{
    case INITIALIZE = 'initialize';
    case TEXTDOCUMENT_DIDOPEN = 'textDocument/didOpen';
    case TEXTDOCUMENT_DIDCHANGE = 'textDocument/didChange';
    case TEXTDOCUMENT_DIDCLOSE = 'textDocument/didClose';
}
