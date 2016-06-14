<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 14:43
 */

namespace Parsers;

use Swis\GoT\Parsers\PhpUnit;

class PhpUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Gitonomy\Git\Repository
     */
    protected $repository;

    protected function setUp()
    {
        $this->repository = new \Gitonomy\Git\Repository('.');
    }


    public function testFindTestFiles()
    {

        $phpUnit = new PhpUnit();
        $results = $phpUnit->run($this->repository);
        $count = 0;
        foreach($results as $result){
            if($result->getFilename() == 'tests/Parsers/PhpUnitTest.php'){
                $count++;
            }
        }
        
        $this->assertGreaterThan(1, $count, 'Check if PhpUnitTest.php is in the results.');
    }
}
