<?php
namespace Swis\GoT\Parsers;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Repository;
use Swis\GoT\Helpers\Finder;
use Swis\GoT\Result;

class Behat implements ParserInterface
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @param Repository $repository
     * @param \Swis\GoT\Result\ValidationInterface $validation
     * @return \Swis\GoT\Result[]
     */
    public function run(Repository $repository, Result\ValidationInterface $validation)
    {

        $files = $this->findFiles($repository);
        $result = [];

        foreach ($files as $file) {
            if ($validation->isValidFile($file) === false) {
                continue;
            }

            $blame = $repository->getBlame($repository->getHeadCommit(), $file);

            /**
             * @var $lines Line[]
             */
            $lines = $blame->getLines();
            foreach ($lines as $line) {
                if ($this->isTestLine($line->getContent())) {
                    $result[$file . ':' . $line->getLine()] = new Result(
                        $file,
                        $line->getLine(),
                        $line->getCommit()->getHash(),
                        $line->getCommit()->getAuthorName(),
                        $line->getCommit()->getAuthorEmail(),
                        $line->getCommit()->getCommitterDate()->getTimestamp(),
                        static::class
                    );
                }
            }
        }

        return $result;
    }

    protected function isTestLine($line)
    {
        return preg_match('/(Scenario: [a-zA-Z0-9]+)/', $line);
    }

    protected function findFiles($repository)
    {
        $grepArgument = '.feature$';
        $finder = new Finder();
        return $finder->grep($repository, $grepArgument);
    }

}