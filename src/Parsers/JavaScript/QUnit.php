<?php

namespace Swis\GoT\Parsers\JavaScript;

class QUnit extends BaseJavaScriptParser
{
    protected function isTestLine($line)
    {
        return preg_match('/(QUnit\.test\()/', $line);
    }
}
