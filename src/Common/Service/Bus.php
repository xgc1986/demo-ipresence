<?php

declare(strict_types=1);

namespace App\Common\Service;

use App\Common\Service\Bus\Document;
use App\Common\Service\Bus\CacheableQuery;
use App\Common\Service\Bus\Query;
use Exception;
use RuntimeException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Stopwatch\Stopwatch;

class Bus
{
    private MessageBusInterface $bus;

    private Cache $cache;

    private Stopwatch $stopwatch;

    public function __construct(MessageBusInterface $bus, Cache $cache, Stopwatch $stopwatch)
    {
        $this->bus = $bus;
        $this->cache = $cache;
        $this->stopwatch = $stopwatch;
    }

    /**
     * @throws Exception
     */
    public function dispatchQuery(Query $query): Document
    {
        $hash = 'Q-' . $this->getName($query);
        $this->stopwatch->start($hash);

        if ($query instanceof CacheableQuery) {
            $value = $this->cache->get($this->hash($query));

            if ($value !== null) {
                $this->stopwatch->stop($hash);
                return $value;
            }
        }

        try {
            $result = $this->bus->dispatch($query)->last(HandledStamp::class);
        } catch (HandlerFailedException $e) {
            if ($e->getPrevious() !== null) {
                throw $e->getPrevious();
            }

            throw $e;
        }

        if ($result === null) {
            throw new RuntimeException('Query does not return a Document');
        }

        if (!$result instanceof HandledStamp) {
            throw new RuntimeException('Unable to process query result');
        }

        if ($query instanceof CacheableQuery) {
            $this->cache->save($this->hash($query), $result->getResult(), $query->getLifetime());
        }

        $this->stopwatch->stop($hash);

        return $result->getResult();
    }

    private function hash(CacheableQuery $query): string
    {
        return str_replace('\\', '-', get_class($query)) . '_' . $query->getHash();
    }

    private function getName(Query $query): string
    {
        $path = explode('\\', get_class($query));

        return array_pop($path) ?? '';
    }
}
