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
    protected static $availableParsers = [
        Behat::class,
        Codeception::class,
        PhpUnit::class,
    ];

    /**
     * @var string
     */
    protected static $repositoryStoragePath;

    protected static $skipPaths;

    /**
     * @return string
     */
    public static function getRepositoryStoragePath()
    {
        return null !== static::$repositoryStoragePath ? static::$repositoryStoragePath : rtrim(
                sys_get_temp_dir(),
                '/\\'
            ) . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $repositoryStoragePath
     */
    public static function setRepositoryStoragePath($repositoryStoragePath)
    {
        self::$repositoryStoragePath = $repositoryStoragePath;
    }

    public static function getAvailableParsers()
    {
        return self::$availableParsers;
    }

    /**
     * @param array $availableParsers
     */
    public static function setAvailableParsers($availableParsers)
    {
        self::$availableParsers = $availableParsers;
    }

    /**
     * @param string $parserClass Classname
     * @throws \Swis\GoT\Exception\InterfaceNotImplementedException
     */
    public static function addAvailableParser($parserClass)
    {
        if (!in_array($parserClass, self::$availableParsers)) {
            if (in_array('ParserInterface', class_implements($parserClass, true))) {
                self::$availableParsers[] = $parserClass;
            } else {
                throw new Exception\InterfaceNotImplementedException();
            }
        }
    }

    /**
     * @return mixed
     */
    public static function getSkipPaths()
    {
        return null !== static::$skipPaths ? static::$skipPaths : array(
            'vendor/',
            'libs/',
            'webbeheer/',
            'tests/_support/',
            'workbench/',
            'tests/ExampleTest.php',
            '_cronjobs/',
        );
    }

    /**
     * @param mixed $skipPaths
     */
    public static function setSkipPaths($skipPaths)
    {
        self::$skipPaths = $skipPaths;
    }

    /**
     * @param string $skipPath
     */
    public static function addSkipPath($skipPath)
    {
        if (!in_array($skipPath, static::getSkipPaths())) {
            static::$skipPaths[] = $skipPath;
        }
    }
}