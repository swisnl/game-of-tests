<?php
namespace Parsers;

use Swis\GoT\Parsers\Codeception\Cept;
use Swis\GoT\Result;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class CodeceptionCeptTest extends BaseParserTestCase
{

    protected static $expectedCount = 2;

    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/codeception/CodeceptionCept.php',
            'tests/_files/codeception/CodeceptionSecondFileCept.php',
        ];
        $expectedCount = 2;
        $parser = new Cept();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }

}
