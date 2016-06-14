<?php
namespace Swis\GoT\Helpers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessUtils;

class Finder
{

    /**
     * @param $repository
     * @param $grepArgument
     * @return array
     */
    public function grep($repository, $grepArgument)
    {
        $process = new Process('git ls-tree -r --name-only HEAD | grep ' . ProcessUtils::escapeArgument($grepArgument));
        $process->setWorkingDirectory($repository->getPath());
        $process->run();
        $output = trim($process->getOutput());
        if ($output === '') {
            return [];
        }
        return explode("\n", $output);
    }
}
