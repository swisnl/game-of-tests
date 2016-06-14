<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 14-6-2016
 * Time: 13:42
 */
class InspectorTest extends PHPUnit_Framework_TestCase
{

    public function testThisShouldBeCounted()
    {
        // This method will be counted
    }

    public function itWillCountThisMethod(){
        // This method should be counted
    }

    public function _thisShouldNotBeCounted(){
        // This method should not be counted
    }
}