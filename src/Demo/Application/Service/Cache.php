<?php

declare(strict_types=1);

namespace App\Demo\Application\Service;

interface Cache
{
    /**
     * @return mixed
     */
    public function get(string $hash);

    /**
     * @param mixed $data
     */
    public function save(string $hash, $data, int $lifetime): void;

    public function delete(string $hash): void;

    public function clear(): void;
}
