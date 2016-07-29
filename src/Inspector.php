<?php
namespace Swis\GoT;

use Gitonomy\Git\Admin;
use Gitonomy\Git\Repository;
use Swis\GoT\Exception\CannotFindRemoteException;
use Swis\GoT\Parsers\ParserInterface;
use Symfony\Component\Process\Process;

class Inspector
{

    /**
     * @param $gitPath
     * @return Repository
     * @throws \Gitonomy\Git\Exception\InvalidArgumentException
     */
    public function getRepositoryByPath($gitPath)
    {
        return new Repository($gitPath);
    }

    /**
     * @param $gitUrl
     * @return Repository
     * @throws \Gitonomy\Git\Exception\RuntimeException
     * @throws \Gitonomy\Git\Exception\InvalidArgumentException
     */
    public function getRepositoryByUrl($gitUrl)
    {
        return $this->gitRepositoryByUrl($gitUrl);
    }

    /**
     * Inspector constructor.
     * @param $repository Repository
     * @return array
     *
     * @throws \Gitonomy\Git\Exception\InvalidArgumentException
     * @throws \Gitonomy\Git\Exception\RuntimeException
     */
    public function inspectRepository($repository)
    {
        $parsers = Settings::getAvailableParsers();

        $parserResults = [];
        foreach ($parsers as $parserClass) {
            /**
             * @var $parser ParserInterface
             */
            $parser = new $parserClass();
            $parserResults = array_merge($parserResults, $parser->run($repository));
        }

        try {
            $remote = $this->getRemoteUrl($repository);
        } catch (CannotFindRemoteException $e) {
            $remote = 'Cannot get remote.origin.url from config';
        }

        return [
            'remote' => $remote,
            'results' => $parserResults,
        ];
    }

    /**
     * @param $repository
     * @return string
     * @throws \Swis\GoT\Exception\CannotFindRemoteException
     */
    protected function getRemoteUrl(Repository $repository)
    {
        try {
            $process = new Process('git config --get remote.origin.url');
            $process->setWorkingDirectory($repository->getPath());
            $process->run();
            $output = trim($process->getOutput());
        } catch (\Exception $e) {
            throw new Exception\CannotFindRemoteException();
        }
        return $output;
    }

    /**
     * @param $gitUrl
     * @return Repository
     * @throws \Gitonomy\Git\Exception\RuntimeException
     * @throws \Gitonomy\Git\Exception\InvalidArgumentException
     */
    protected function gitRepositoryByUrl($gitUrl)
    {
        $reposStoragePath = $this->getPathToForRepositoryUrl($gitUrl);
        if (is_dir($reposStoragePath)) {
            $repository = $this->getRepositoryByPath($reposStoragePath);
            $repository->run('fetch', ['origin', '+refs/heads/*:refs/heads/*', '--prune']);
            return $repository;
        } else {
            $repository = Admin::cloneTo($reposStoragePath, $gitUrl);
            return $repository;
        }
    }

    /**
     * @param $gitUrl
     * @return string
     */
    protected function getPathToForRepositoryUrl($gitUrl)
    {
        return Settings::getRepositoryStoragePath() . md5($gitUrl);
    }
}