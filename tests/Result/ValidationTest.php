<?php
namespace Swis\GoT\Tests\Result;

use PHPUnit_Framework_TestCase;
use Swis\GoT\Result\Validation;
use Swis\GoT\Settings\Factory;

class ValidationTest extends PHPUnit_Framework_TestCase
{

    public function testDefaultsGiveFalse()
    {
        $settings = Factory::create();
        $validation = new Validation($settings);
        $paths = $settings->getSkipPaths();


        foreach ($paths as $path) {
            static::assertFalse($validation->isValidFile($path . 'test.php'));
        }
    }

    public function testAddSkippedPathToSettings()
    {
        $settings = Factory::create();
        $settings->addSkipPath('test-path/');
        $validation = new Validation($settings);


        static::assertFalse($validation->isValidFile('test-path/lol'));
        static::assertTrue($validation->isValidFile('not-test-path/lol'));
    }
}
