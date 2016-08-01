<?php
namespace Swis\GoT\Tests;

use Gitonomy\Git\Repository;
use Swis\GoT\Inspector;
use Swis\GoT\Settings\SettingsFactory;

class InspectorTest extends \PHPUnit_Framework_TestCase
{

    public function testInspectThisRespository()
    {
        $settings = SettingsFactory::create();

        $inspector = new Inspector($settings);
        $repository = $inspector->getRepositoryByPath('.');

        static::assertInstanceOf(Repository::class, $repository);

        $results = $inspector->inspectRepository($repository);

        static::assertCount(26, $results['results']);

        static::assertTrue(in_array($results['remote'], ['https://github.com/swisnl/game-of-tests', 'https://github.com/swisnl/game-of-tests.git', 'git@github.com:swisnl/game-of-tests.git', 'git@github.com:swisnl/game-of-tests']), 'Check if remote is correct');
    }
}

