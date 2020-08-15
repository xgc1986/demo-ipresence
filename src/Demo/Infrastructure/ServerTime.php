<?php

declare(strict_types=1);

namespace App\Demo\Infrastructure;

use Symfony\Component\Stopwatch\Stopwatch;

class ServerTime
{
    private Stopwatch $stopwatch;

    /**
     * @var string[]
     */
    private array $marks;

    public function __construct()
    {
        $this->stopwatch = new Stopwatch();
        $this->marks = [];
    }

    public function start(string $key): void
    {
        $this->stopwatch->start($key);
    }

    public function stop(string $key): void
    {
        $this->stopwatch->stop($key);
        $this->marks[] = $key . ';dur=' . $this->stopwatch->getEvent($key)->getDuration();
    }

    public function add(string $key): void
    {
        $this->marks[] = $key;
    }

    public function serialize(): string
    {
        return join(', ', $this->marks);
    }
}
