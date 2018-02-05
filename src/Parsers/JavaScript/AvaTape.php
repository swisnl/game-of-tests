<?php

namespace Swis\GoT\Parsers\JavaScript;

class AvaTape extends BaseJavaScriptParser
{
    protected function isTestLine($line)
    {
        return preg_match('/\s(test\()/', $line);
    }
}
