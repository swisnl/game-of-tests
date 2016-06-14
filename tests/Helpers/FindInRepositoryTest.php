<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 14:24
 */
class FindInRepositoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \Gitonomy\Git\Repository
     */
    protected $repository;

    protected function setUp()
    {
        $this->repository = new \Gitonomy\Git\Repository('.');
    }

    public function testFindFileWithGrep()
    {
        $result = \Swis\GoT\Helpers\FindInRepository::grep($this->repository, 'TestFileForGrep');
        static::assertCount(1, $result);
    }

    public function testFindFileWithStarGrep()
    {

        $result = \Swis\GoT\Helpers\FindInRepository::grep($this->repository, 'ForGrep$');
        static::assertCount(1, $result);
    }

    public function testFindFileWithGrepNonExisting()
    {

        $resultNonExisting = \Swis\GoT\Helpers\FindInRepository::grep($this->repository, 'NonExistingTestFile');
        static::assertCount(0, $resultNonExisting);
    }

    public function testFindFileWithGrepFileEndsWith()
    {

        $resultFilePart = \Swis\GoT\Helpers\FindInRepository::grep($this->repository, 'TestFileFor$');
        static::assertCount(0, $resultFilePart);
    }

}
