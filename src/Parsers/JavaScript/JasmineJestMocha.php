<?php

namespace Swis\GoT\Parsers\JavaScript;

class JasmineJestMocha extends BaseJavaScriptParser
{
    protected function isTestLine($line)
    {
        return preg_match('/\s(it\()/', $line);
    }
}
