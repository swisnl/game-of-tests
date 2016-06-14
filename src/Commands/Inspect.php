<?php
namespace Swis\GoT\Commands;

use Illuminate\Console\Command;
use Swis\GoT\Inspector;

class Inspect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'got:inspect {repositoryUrl}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inspect a repository by URL';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Gitonomy\Git\Exception\RuntimeException
     * @throws \Gitonomy\Git\Exception\InvalidArgumentException
     */
    public function handle()
    {
        $inspector = new Inspector();

        $repository = $inspector->getRepositoryByUrl($this->argument('repositoryUrl'));

        $inspectedRepository = $inspector->inspectRepository($repository);

        $header = array_keys((array)$inspectedRepository[key($inspectedRepository)]);

        reset($inspectedRepository['results']);
        array_walk(
            $inspectedRepository['results'],
            function (&$row) {
                $row = (array)$row;
            }
        );

        $this->info($inspectedRepository['remote']);
        $this->table($header, $inspectedRepository['results']);
    }
}
