<?php
use \AcceptanceTester;

class CodeceptionCest extends \Base_ModuleCest
{

    public function thisMethodShouldBeCounted(AcceptanceTester $I)
    {
    }

    public function thisMethodShouldAlsoBeCounted(AcceptanceTester $I)
    {
    }

    public function _shouldNotBeCounted(AcceptanceTester $I)
    {
    }

    protected function protectedShouldNotBeCounted(AcceptanceTester $I)
    {
    }

    private function privateShouldNotBeCounted(AcceptanceTester $I)
    {
    }
}