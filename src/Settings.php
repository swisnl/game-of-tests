<?php

namespace Swis\GoT;

use Swis\GoT\Parsers\Behat;
use Swis\GoT\Parsers\Codeception;
use Swis\GoT\Parsers\ParserInterface;
use Swis\GoT\Parsers\PhpUnit;

class Settings
{
    /**
     * @var string|ParserInterface[] Classes implementing ParserInterface
     */
    protected $availableParsers;

    /**
     * @var string
     */
    protected $repositoryStoragePath;

    /**
     * @var array
     */
    protected $skipPaths;

    /**
     * @return string
     */
    public function getRepositoryStoragePath()
    {
        return $this->repositoryStoragePath;
    }

    /**
     * @param string $repositoryStoragePath
     */
    public function setRepositoryStoragePath($repositoryStoragePath)
    {
        $this->repositoryStoragePath = $repositoryStoragePath;
    }

    /**
     * @return string|\Swis\GoT\Parsers\ParserInterface[]
     */
    public function getAvailableParsers()
    {
        return $this->availableParsers;
    }

    /**
     * @param array $availableParsers
     */
    public function setAvailableParsers($availableParsers)
    {
        $this->availableParsers = $availableParsers;
    }

    /**
     * @param string $parserClass Classname
     * @throws \Swis\GoT\Exception\InterfaceNotImplementedException
     */
    public function addAvailableParser($parserClass)
    {
        if (!in_array($parserClass, $this->availableParsers)) {
            if (in_array('ParserInterface', class_implements($parserClass, true))) {
                $this->availableParsers[] = $parserClass;
            } else {
                throw new Exception\InterfaceNotImplementedException();
            }
        }
    }

    /**
     * @return array
     */
    public function getSkipPaths()
    {
        return $this->skipPaths;
    }

    /**
     * @param array $skipPaths
     */
    public function setSkipPaths($skipPaths)
    {
        $this->skipPaths = $skipPaths;
    }

    /**
     * @param string $skipPath
     */
    public function addSkipPath($skipPath)
    {
        if (!in_array($skipPath, $this->getSkipPaths())) {
            $this->skipPaths[] = $skipPath;
        }
    }
}