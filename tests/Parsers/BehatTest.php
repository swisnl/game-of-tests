<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 14:43
 */

namespace Parsers;

use Swis\GoT\Parsers\Behat;
use Swis\GoT\Result;
use Swis\GoT\Tests\Parsers\BaseParserTestCase;

class BehatTest extends BaseParserTestCase
{

    public function testFindTestFiles()
    {
        $expectedFiles = [
            'tests/_files/behat/article.feature',
            'tests/_files/behat/breadcrumb.feature',
        ];
        $expectedCount = 5;
        $parser = new Behat();

        $this->runParserTest($parser, $expectedFiles, $expectedCount);
    }

}
