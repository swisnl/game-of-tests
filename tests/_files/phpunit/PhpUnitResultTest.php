<?php
class PhpUnitResultTest extends PHPUnit_Framework_TestCase
{
    public function testThisShouldBeCounted()
    {
        // This method will be counted
    }

    public function itWillCountThisMethod()
    {
        // This method should be counted
    }

    public function _thisShouldNotBeCounted()
    {
        // This method should not be counted
    }

    public function _andItShouldNotBeCounted()
    {
        // This method should not be counted
    }

    public function _andItShouldNotBeCountedTest()
    {
        // This method should not be counted
    }

    protected function testProtectedShouldNotBeCounted()
    {
    }

    private function testPrivateShouldNotBeCounted()
    {
    }
}