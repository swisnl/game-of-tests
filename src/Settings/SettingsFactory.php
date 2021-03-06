<?php
namespace Swis\GoT\Settings;

use Swis\GoT\Parsers\Behat;
use Swis\GoT\Parsers\Codeception;
use Swis\GoT\Parsers\JavaScript\AvaTape;
use Swis\GoT\Parsers\JavaScript\JasmineJestMocha;
use Swis\GoT\Parsers\JavaScript\QUnit;
use Swis\GoT\Parsers\PhpUnit;
use Swis\GoT\Parsers\SCSS;
use Swis\GoT\Settings;

class SettingsFactory
{
    /**
     * @param bool $loadDefaultSettings Load default settings
     * @return \Swis\GoT\Settings|\Swis\GoT\Settings\DefaultSettings
     */
    public static function create($loadDefaultSettings = true)
    {
        $settings = new Settings();

        if ($loadDefaultSettings === true) {
            $settings->setAvailableParsers([
              Behat::class,
              Codeception::class,
              PhpUnit::class,
              AvaTape::class,
              JasmineJestMocha::class,
              QUnit::class,
              SCSS::class,
            ]);

            $settings->setSkipPaths([
              'bower_components/',
              'node_modules/',
              'vendor/',
              'libs/',
              'tests/_support/',
              'workbench/',
              'tests/ExampleTest.php',
            ]);

            $settings->setRepositoryStoragePath(rtrim(
                sys_get_temp_dir(),
                '/\\'
              ) . DIRECTORY_SEPARATOR);
        }

        return $settings;
    }
}