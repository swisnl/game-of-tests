<?php
namespace Parsers;

use Swis\GoT\Parsers\Codeception\Cest;
use Swis\GoT\Result;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class CodeceptionCestTest extends BaseParserTestCase
{

    protected static $expectedCount = 2;

    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/codeception/CodeceptionCest.php'
        ];
        $expectedCount = 2;
        $parser = new Cest();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }

}
