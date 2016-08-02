<?php
namespace Swis\GoT\Helpers;

use Gitonomy\Git\Repository;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessUtils;

class Finder
{

    /**
     * @param Repository $repository
     * @param string $grepArgument
     * @return array
     */
    public function grep($repository, $grepArgument)
    {
        $command = 'git ls-tree -r --name-only HEAD | grep ' . ProcessUtils::escapeArgument($grepArgument);
        return $this->getCommandResult($repository, $command);
    }

    /**
     * @param Repository $repository
     * @param string $grepArgument
     * @param string $since 
     * @return array
     */
    public function grepTimed($repository, $grepArgument, $since = '1 day ago'){
        // git log --since '24 day ago' --oneline --pretty=format: --name-only | grep Test.php
        $command = 'git log --since \'' . ProcessUtils::escapeArgument($since) . '\' --oneline --pretty=format: --name-only | grep ' . ProcessUtils::escapeArgument($grepArgument);
        return $this->getCommandResult($repository, $command);
    }

    /**
     * @param $repository
     * @param $command
     * @return array
     */
    protected function getCommandResult($repository, $command)
    {
        $process = new Process($command);
        $process->setWorkingDirectory($repository->getPath());
        $process->run();
        $output = trim($process->getOutput());
        if ($output === '') {
            return [];
        }
        return explode("\n", $output);
    }
}
