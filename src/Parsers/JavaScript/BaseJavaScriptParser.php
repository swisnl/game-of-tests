<?php

namespace Swis\GoT\Parsers\JavaScript;

use Gitonomy\Git\Blame\Line;
use Gitonomy\Git\Repository;
use Swis\GoT\Parsers\BaseParser;
use Swis\GoT\Result;

abstract class BaseJavaScriptParser extends BaseParser
{
    /**
     * @param Repository                           $repository
     * @param \Swis\GoT\Result\ValidationInterface $validation
     *
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
                    $result[$file.':'.$line->getLine()] = new Result(
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
        return $this->finder->grep($repository, 'test.js$\|spec.js$');
    }

    abstract protected function isTestLine($line);
}