<?php

declare(strict_types=1);

namespace App\Common\Command;

use App\Common\Service\Cache;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmptyCacheCommand extends Command
{
    protected static $defaultName = 'main:cache:empty';

    private Cache $cache;

    public function __construct(Cache $cache)
    {
        parent::__construct();
        $this->cache = $cache;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->cache->clear();
        $output->writeln('Cache emptied');
        return 0;
    }
}
