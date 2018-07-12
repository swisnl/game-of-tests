<?php
namespace Parsers;

use Swis\GoT\Parsers\SCSS;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class SCSSTest extends BaseParserTestCase
{

    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/scss/test.scss',
        ];
        $expectedCount = 2;
        $parser = new SCSS();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }

}
