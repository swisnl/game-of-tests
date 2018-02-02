<?php

namespace Parsers\JavaScript;

use Swis\GoT\Parsers\JavaScript\JasmineJestMocha;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class JasmineJestMochaTest extends BaseParserTestCase
{
    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/javascript/JavaScriptResult.test.js',
            'tests/_files/javascript/JavaScriptResult.spec.js'
        ];
        $expectedCount = 8;
        $parser = new JasmineJestMocha();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }
}
