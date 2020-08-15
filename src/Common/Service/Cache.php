<?php

declare(strict_types=1);

namespace App\Common\Service;

use RuntimeException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Cache
{
    private FilesystemAdapter $cache;

    public function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    /**
     * @return mixed|null
     */
    public function get(string $hash)
    {
        $data = $this->cache->getItem($hash);

        if (!$data->isHit()) {
            return null;
        }

        return $data->get();
    }

    /**
     * @param mixed $data
     */
    public function save(string $hash, $data, int $lifetime = 10): void
    {
        if ($lifetime < 0) {
            throw new RuntimeException('lifetime must be a positive number');
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
