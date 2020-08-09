<?php

declare(strict_types=1);

namespace App\Demo\Infrastructure;

use App\Demo\Application\Service\Cache;
use InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class FilesystemCache implements Cache
{
    private FilesystemAdapter $cache;

    public function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    public function get(string $hash)
    {
        $data = $this->cache->getItem($hash);

        if (!$data->isHit()) {
            return null;
        }

        return $data->get();
    }

    public function save(string $hash, $data, int $lifetime = 10): void
    {
        if ($lifetime < 0) {
            throw new InvalidArgumentException('lifetime must be a positive number');
        }

        $item = $this->cache->getItem($hash);
        $item->set($data);
        $item->expiresAfter($lifetime);
        $this->cache->save($item);
    }

    public function delete(string $hash): void
    {
        $this->cache->deleteItem($hash);
    }

    public function clear(): void
    {
        $this->cache->clear();
    }
}
