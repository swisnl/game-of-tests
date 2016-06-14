<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 3-6-2016
 * Time: 13:01
 */

namespace Swis\GoT\Parsers;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Commit;
use Gitonomy\Git\Repository;
use Swis\GoT\Helpers\FindInRepository;
use Swis\GoT\Parsers\Codeception\Cept;
use Swis\GoT\Parsers\Codeception\Cest;
use Swis\GoT\Result;
use Symfony\Component\Process\Process;

class PhpUnit implements ParserInterface
{

    /**
     * @param Repository $repository
     * @return Result[]
     * @throws \Gitonomy\Git\Exception\RuntimeException
     */
    public static function run(Repository $repository){

        $files = static::findFiles($repository);
        $result = [];


        foreach($files as $file){
            if(Result\Validation::isValidFile($file) === false){
                continue;
            }

            $blame = $repository->getBlame($repository->getHead(), $file);

            /**
             * @var $lines Line[]
             */
            $lines = $blame->getLines();
            foreach($lines as $line){
                if(static::isTestLine($line->getContent())){
                    $result[$file.':'.$line->getLine()] = new Result(
                        $file,
                        $line->getLine(),
                        $line->getCommit()->getHash(),
                        $line->getCommit()->getAuthorName(),
                        $line->getCommit()->getAuthorEmail(),
                        $line->getCommit()->getCommitterDate()->getTimestamp(),
                        self::class
                    );
                }
            }
        }

        return $result;
    }

    protected static function isTestLine($line){
        return preg_match('/(public function (test|it)\w+)/', $line);
    }

    protected static function findFiles($repository)
    {
        $grepArgument = 'Test.php$';
        return FindInRepository::grep($repository, $grepArgument);
    }

}