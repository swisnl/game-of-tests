<?php
namespace Swis\GoT\Parsers;

use Swis\GoT\Helpers\Finder;

use Swis\GoT\Result;

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