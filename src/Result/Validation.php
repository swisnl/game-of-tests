<?php
namespace Swis\GoT\Result;

use Swis\GoT\Result;
use Swis\GoT\Settings;

class Validation {

    public static function isValidFile($file){
        foreach (Settings::getSkipPaths() as $path){
            if(strpos($file, $path) === 0){
                return false;
            }
        }
        return true;
    }

}