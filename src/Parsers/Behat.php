<?php
/**
 * Created by PhpStorm.
 * User: bjorn
 * Date: 3-6-2016
 * Time: 13:01
 */

namespace Swis\GoT\Parsers;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Repository;
use Swis\GoT\Helpers\FindInRepository;
use Swis\GoT\Result;
use Symfony\Component\Process\Process;

class Behat implements ParserInterface
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @param Repository $repository
     * @return Result[]
     */
    public function run(Repository $repository){

        $files = $this->findFiles($repository);
        $result = [];

        
        foreach($files as $file){
            if(Result\Validation::isValidFile($file) === false){
                continue;
            }

            $blame = $repository->getBlame($repository->getHeadCommit(), $file);

            /**
             * @var $lines Line[]
             */
            $lines = $blame->getLines();
            foreach($lines as $line){
                if($this->isTestLine($line->getContent())){
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

    protected function isTestLine($line){
        return preg_match('/(Scenario: [a-zA-Z0-9]+)/', $line);
    }

    protected function findFiles($repository)
    {
        $grepArgument = '.feature$';
        return FindInRepository::grep($repository, $grepArgument);
    }

}