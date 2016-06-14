<?php
namespace Swis\GoT\Tests\Parsers;
use PHPUnit_Framework_TestCase;
use Swis\GoT\Parsers\ParserInterface;
use Swis\GoT\Result;

class BaseParserTestCase  extends PHPUnit_Framework_TestCase {
    /**
     * @var \Gitonomy\Git\Repository
     */
    protected $repository;

    protected function setUp()
    {
        $this->repository = new \Gitonomy\Git\Repository('.');
    }


    /**
     * @param ParserInterface $parser
     * @param array $expectedFiles What files do we expect as result
     * @param int $expectedCount How many tests should be counted
     */
    protected function runParserTest($parser, $expectedFiles, $expectedCount)
    {
        $results = $parser->run($this->repository);
        $count = 0;
        foreach ($results as $result) {
            static::assertInstanceOf(Result::class, $result);

            if (in_array($result->getFilename(), $expectedFiles)) {
                $count++;
            }
        }
        static::assertEquals(
            $expectedCount,
            $count,
            'Check if file list has 2 results (one ignored method).'
        );
    }
}