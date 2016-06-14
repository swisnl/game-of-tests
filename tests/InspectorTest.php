<?php
namespace Swis\GoT\Tests;

use Gitonomy\Git\Repository;
use Swis\GoT\Inspector;

class InspectorTest extends \PHPUnit_Framework_TestCase
{

    public function testInspectThisRespository()
    {
        $inspector = new Inspector();
        $repository = $inspector->getRepositoryByPath('.');

        static::assertInstanceOf(Repository::class, $repository);

        $results = $inspector->inspectRepository($repository);

        static::assertCount(26, $results['results']);
        static::assetTrue(in_array($results['remote'], ['https://github.com/swisnl/game-of-tests.git', 'git@github.com:swisnl/game-of-tests']), 'Check if remote is correct');
    }
}

