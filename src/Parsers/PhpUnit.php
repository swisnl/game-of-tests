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
use Swis\GoT\Helpers\Finder;
use Swis\GoT\Parsers\Codeception\Cept;
use Swis\GoT\Parsers\Codeception\Cest;
use Swis\GoT\Result;
use Symfony\Component\Process\Process;

class PhpUnit extends BaseParser implements ParserInterface
{

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
        return preg_match('/(public function (test|it)\w+)/', $line);
    }

    protected function findFiles($repository)
    {
        return $this->finder->grep($repository, 'Test.php$');
    }

}