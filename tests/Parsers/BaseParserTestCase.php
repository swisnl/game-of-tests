<?php
namespace Swis\GoT\Tests\Parsers;

use PHPUnit_Framework_TestCase;
use Swis\GoT\Parsers\ParserInterface;
use Swis\GoT\Result;
use Swis\GoT\Settings\SettingsFactory;

class BaseParserTestCase extends PHPUnit_Framework_TestCase
{
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
     * @return Result[]
     */
    protected function runParserTest($parser, $expectedFiles, $expectedCount)
    {
        $settings = SettingsFactory::create();
        $validation = new Result\Validation($settings);

        $results = $parser->run($this->repository, $validation);
        $count = 0;
        foreach ($results as $result) {
            static::assertInstanceOf(Result::class, $result);

            static::assertEquals(get_class($parser), $result->getParser());

            if (in_array($result->getFilename(), $expectedFiles)) {
                $count++;
            }
        }
        static::assertEquals(
            $expectedCount,
            $count,
            'Check if file list has ' . $expectedCount . ' results.'
        );

        return $results;
    }
}