<?php
namespace Swis\GoT\Parsers;

use Gitonomy\Git\Repository;
use Swis\GoT\Parsers\Codeception\Cept;
use Swis\GoT\Parsers\Codeception\Cest;
use Swis\GoT\Result;

class Codeception implements ParserInterface
{
    protected static $types = [
        Cept::class,
        Cest::class,
    ];

    /**
     * @param Repository $repository
     * @return Result[]
     */
    public function run(Repository $repository)
    {
        $results = [];
        foreach (static::$types as $type) {
            /** @var ParserInterface $parser */
            $parser = new $type();
            $results += $parser->run($repository);
        }
        return $results;
    }
}