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
        $command = 'git ls-tree -r --name-only HEAD | grep $GREPARG';
        return $this->getCommandResult($repository, $command, ['GREPARG' => $grepArgument]);
    }

    /**
     * @param Repository $repository
     * @param string $grepArgument
     * @param string $since
     * @return array
     */
    public function grepTimed($repository, $grepArgument, $since = '1 day ago'){
        $command = 'git log --since \'$SINCE\' --oneline --pretty=format: --name-only | grep $GREPARG';
        return $this->getCommandResult($repository, $command, ['SINCE' => $since, 'GREPARG' => $grepArgument]);
    }

    /**
     * @param $repository
     * @param $command
     * @param array $arguments
     * @return array
     */
    protected function getCommandResult($repository, $command, array $arguments = [])
    {
        $process = new Process($command);
        $process->setWorkingDirectory($repository->getPath());
        $process->run(null, $arguments);
        $output = trim($process->getOutput());
        if ($output === '') {
            return [];
        }
        return explode("\n", $output);
    }
}
