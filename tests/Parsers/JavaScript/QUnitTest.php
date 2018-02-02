<?php

namespace Parsers\JavaScript;

use Swis\GoT\Parsers\JavaScript\QUnit;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class QUnitTest extends BaseParserTestCase
{
    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/javascript/JavaScriptResult.test.js',
            'tests/_files/javascript/JavaScriptResult.spec.js'
        ];
        $expectedCount = 1;
        $parser = new QUnit();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }
}
