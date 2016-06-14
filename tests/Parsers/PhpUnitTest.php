<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 14:43
 */

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
        $expectedCount = 4;
        $parser = new PhpUnit();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }

}
