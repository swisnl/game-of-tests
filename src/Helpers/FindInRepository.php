<?php
namespace Swis\GoT\Helpers;
use Symfony\Component\Process\Process;

class FindInRepository {

    /**
     * @param $repository
     * @param $grepArgument
     * @return string
     */
    public static function grep($repository, $grepArgument)
    {
        $process = new Process('git ls-tree -r --name-only HEAD | grep ' . $grepArgument);
        $process->setWorkingDirectory($repository->getPath());
        $process->run();
        $output = trim($process->getOutput());
        if($output === ''){
            return [];
        }
        return explode("\n", $output);
    }
}
