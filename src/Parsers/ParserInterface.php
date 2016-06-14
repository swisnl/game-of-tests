<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 11:43
 */
namespace Swis\GoT\Parsers;

use Gitonomy\Git\Repository;
use Swis\GoT\Result;

interface ParserInterface
{
    /**
     * @param Repository $repository
     * @return Result[]
     * @throws \Gitonomy\Git\Exception\RuntimeException
     */
    public static function run(Repository $repository);
}