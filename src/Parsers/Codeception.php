<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 3-6-2016
 * Time: 13:01
 */

namespace Swis\GoT\Parsers;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Commit;
use Gitonomy\Git\Repository;
use Swis\GoT\Parsers\Codeception\Cept;
use Swis\GoT\Parsers\Codeception\Cest;
use Swis\GoT\Result;
use Symfony\Component\Process\Process;

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
    public static function run(Repository $repository){
        $results = [];
        foreach(static::$types as $type){
            $parser = new $type();
            $results += $parser->run($repository);
        }
        return $results;
    }

}