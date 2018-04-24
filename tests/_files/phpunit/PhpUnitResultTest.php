<?php
class PhpUnitResultTest extends PHPUnit_Framework_TestCase
{
    public function testThisShouldBeCounted()
    {
        // This method will be counted
    }

    /** @test */
    public function itWillCountThisMethod()
    {
        // This method should be counted
    }

    /**
     * @test
     */
    public function thisMethodWillAlsoBeCounted()
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
        // This method should not be counted
    }

    private function testPrivateShouldNotBeCounted()
    {
        // This method should not be counted
    }

    /** @test */
    protected function itShouldNotCountProtected()
    {
        // This method should not be counted
    }

    /** @test */
    private function itShouldNotCountPrivate()
    {
        // This method should not be counted
    }

    /**
     * Todo:
     *      Test that is commented still counts if it is a block comment.
     */

    // public function testCommentShouldNotCount(){
    // }

    /**
    public function testCommentBlockShouldNotCount(){
    }
    **/
}