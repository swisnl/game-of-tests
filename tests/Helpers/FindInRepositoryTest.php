<?php
namespace Swis\GoT\Tests\Helpers;

use PHPUnit_Framework_TestCase;

class FindInRepositoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \Gitonomy\Git\Repository
     */
    protected $repository;

    /**
     * @var \Swis\GoT\Helpers\Finder $finder
     */
    protected $finder;

    protected function setUp()
    {
        $this->repository = new \Gitonomy\Git\Repository('.');
        $this->finder = new \Swis\GoT\Helpers\Finder();
    }

    public function testFindFileWithGrep()
    {
        $result = $this->finder->grep($this->repository, 'TestFileForGrep');
        static::assertCount(1, $result);
    }

    public function testFindFileWithStarGrep()
    {

        $result = $this->finder->grep($this->repository, 'ForGrep$');
        static::assertCount(1, $result);
    }

    public function testFindFileWithGrepNonExisting()
    {

        $resultNonExisting = $this->finder->grep($this->repository, 'NonExistingTestFile');
        static::assertCount(0, $resultNonExisting);
    }

    public function testFindFileWithGrepFileEndsWith()
    {

        $resultFilePart = $this->finder->grep($this->repository, 'TestFileFor$');
        static::assertCount(0, $resultFilePart);
    }

}
