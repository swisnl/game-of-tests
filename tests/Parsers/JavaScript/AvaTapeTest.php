<?php

namespace Parsers\JavaScript;

use Swis\GoT\Parsers\JavaScript\AvaTape;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class AvaTapeTest extends BaseParserTestCase
{
    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/javascript/JavaScriptResult.test.js',
            'tests/_files/javascript/JavaScriptResult.spec.js'
        ];
        $expectedCount = 4;
        $parser = new AvaTape();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }
}
