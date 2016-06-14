<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 14:24
 */
class FindInRepositoryTest extends PHPUnit_Framework_TestCase
{

    public function testFindFileWithGrep()
    {
        $repository = new \Gitonomy\Git\Repository('.');

        $result = \Swis\GoT\Helpers\FindInRepository::grep($repository, 'TestFileForGrep');
        static::assertCount(1, $result);

        $resultNonExisting = \Swis\GoT\Helpers\FindInRepository::grep($repository, 'NonExistingTestFile');
        static::assertCount(0, $result);
    }
}
