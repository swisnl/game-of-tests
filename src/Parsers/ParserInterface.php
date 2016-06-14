<?php
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
    public function run(Repository $repository);

}