<?php

declare(strict_types=1);

namespace App\Demo\Infrastructure;

use App\Demo\Application\Document\Document;
use App\Demo\Application\Query\CacheableQuery;
use App\Demo\Application\Query\Query;
use App\Demo\Application\Service\Bus;
use App\Demo\Application\Service\Cache;
use Exception;
use RuntimeException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class SymfonyBus implements Bus
{
    private MessageBusInterface $bus;

    private Cache $cache;

    public function __construct(MessageBusInterface $bus, Cache $cache)
    {
        $this->bus = $bus;
        $this->cache = $cache;
    }

    /**
     * @param Query $query
     * @return Document
     * @throws Exception
     */
    public function dispatchQuery(Query $query): Document
    {
        if ($query instanceof CacheableQuery) {
            $value = $this->cache->get($this->hash($query));

            if ($value !== null) {
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

        return $result->getResult();
    }

    private function hash(CacheableQuery $query): string
    {
        return str_replace('\\', '-', get_class($query)) . '_' . $query->getHash();
    }
}
