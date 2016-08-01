<?php
namespace Swis\GoT\Parsers;

use Gitonomy\Git\Repository;
use Swis\GoT\Result;

interface ParserInterface
{
    /**
     * @param Repository $repository
     * @param \Swis\GoT\Result\ValidationInterface $validation
     * @return \Swis\GoT\Result[]
     */
    public function run(Repository $repository, Result\ValidationInterface $validation);

}