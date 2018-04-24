<?php
namespace Parsers;

use Swis\GoT\Parsers\PhpUnit;
use Swis\GoT\Result;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class PhpUnitTest extends BaseParserTestCase
{

    protected static $expectedCount = 2;

    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/phpunit/PhpUnitResultTest.php'
        ];
        $expectedCount = 5;
        $parser = new PhpUnit();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }

}
