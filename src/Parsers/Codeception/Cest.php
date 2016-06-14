<?php

namespace Swis\GoT\Parsers\Codeception;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Repository;
use Swis\GoT\Helpers\Finder;
use Swis\GoT\Parsers\ParserInterface;
use Swis\GoT\Result;

class Cest implements ParserInterface
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @param Repository $repository
     * @return Result[]
     * @throws \Gitonomy\Git\Exception\RuntimeException
     */
    public function run(Repository $repository){

        $files = $this->findFiles($repository);
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
        return preg_match('/(public function [^_][a-zA-Z0-9]+)/', $line);
    }

    protected function findFiles($repository)
    {
        $grepArgument = 'Cest.php$';
        $finder = new Finder();
        return $finder->grep($repository, $grepArgument);
    }

}