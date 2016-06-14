<?php

namespace Swis\GoT\Parsers\Codeception;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Repository;
use Swis\GoT\Helpers\FindInRepository;
use Swis\GoT\Parsers\ParserInterface;
use Swis\GoT\Result;
use Symfony\Component\Process\Process;

class Cept implements ParserInterface {

    /**
     * @param Repository $repository
     * @return Result[]
     * @throws \Gitonomy\Git\Exception\RuntimeException
     */
    public function run(Repository $repository){

        $files = $this->findFiles($repository);
        $result = [];


        foreach($files as $file) {
            if(Result\Validation::isValidFile($file) === false){
                continue;
            }
            
            $blame = $repository->getBlame($repository->getHead(), $file);

            /**
             * @var $lines Line[]
             */
            $line = $blame->getLine(1);
            $result[$file . ':' . $line->getLine()] = new Result(
                $file,
                $line->getLine(),
                $line->getCommit()->getHash(),
                $line->getCommit()->getAuthorName(),
                $line->getCommit()->getAuthorEmail(),
                $line->getCommit()->getCommitterDate()->getTimestamp(),
                self::class
            );
        }

        return $result;
    }

    protected function findFiles($repository)
    {
        $grepArgument = 'Cept.php$';
        return FindInRepository::grep($repository, $grepArgument);
    }


}