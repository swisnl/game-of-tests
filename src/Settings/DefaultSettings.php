<?php
namespace Swis\GoT\Settings;

use Swis\GoT\Parsers\Behat;
use Swis\GoT\Parsers\Codeception;
use Swis\GoT\Parsers\PhpUnit;
use Swis\GoT\Settings;

class DefaultSettings extends Settings {

    /**
     * DefaultSettings constructor.
     */
    public function __construct(){
        $this->setAvailableParsers([
          Behat::class,
          Codeception::class,
          PhpUnit::class,
        ]);

        $this->setSkipPaths([
          'vendor/',
          'libs/',
          'webbeheer/',
          'tests/_support/',
          'workbench/',
          'tests/ExampleTest.php',
          '_cronjobs/',
        ]);

        $this->setRepositoryStoragePath(rtrim(
            sys_get_temp_dir(),
            '/\\'
          ) . DIRECTORY_SEPARATOR);
    }
}