<?php
namespace Swis\GoT\Parsers;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Repository;
use Swis\GoT\Result;

class PhpUnit extends BaseParser
{
    private $lastAtTestLine;

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

            $blame = $repository->getBlame($repository->getHead(), $file);

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

    protected function findFiles($repository)
    {
        return $this->finder->grep($repository, 'Test.php$\|Tests.php$');
    }

    protected function isTestLine($line)
    {
        // public function test...
        if (preg_match('/(public function test\w+)/', $line)) {
            $this->lastAtTestLine = null;

            return true;
        }

        // @test
        if (preg_match('/(\s@test)/', $line)) {
            $this->lastAtTestLine = $line;

            return false;
        }

        // @test found earlier
        if ($this->lastAtTestLine !== null) {
            // public function ...
            if (preg_match('/(public function \w+)/', $line)) {
                $this->lastAtTestLine = null;

                return true;
            }

            // other access keyword
            if (preg_match('/((public|protected|private) \w+)/', $line)) {
                $this->lastAtTestLine = null;

                return false;
            }
        }

        return false;
    }
}