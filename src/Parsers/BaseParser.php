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
use Swis\GoT\Helpers\Finder;
use Swis\GoT\Parsers\Codeception\Cept;
use Swis\GoT\Parsers\Codeception\Cest;
use Swis\GoT\Result;
use Symfony\Component\Process\Process;

abstract class BaseParser implements ParserInterface
{
    /**
     * @var Finder
     */
    protected $finder;

    /**
     * PhpUnit constructor.
     */
    public function __construct()
    {
        $this->finder = new Finder();
    }

    /**
     * @return Finder
     */
    public function getFinder()
    {
        return $this->finder;
    }

    /**
     * @param Finder $finder
     */
    public function setFinder($finder)
    {
        $this->finder = $finder;
    }

}