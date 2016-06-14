<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 13:59
 */
class ValidationTest extends PHPUnit_Framework_TestCase
{

    public function testDefaultsGiveFalse()
    {
        $paths = \Swis\GoT\Settings::getSkipPaths();
        foreach($paths as $path){
            static::assertFalse(\Swis\GoT\Result\Validation::isValidFile($path . 'test.php'));
        }
    }

    public function testAddSkippedPathToSettings()
    {
        \Swis\GoT\Settings::addSkipPath('test-path/');

        static::assertFalse(\Swis\GoT\Result\Validation::isValidFile('test-path/lol'));
        static::assertTrue(\Swis\GoT\Result\Validation::isValidFile('not-test-path/lol'));
    }
}
