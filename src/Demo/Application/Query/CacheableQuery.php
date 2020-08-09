<?php

declare(strict_types=1);

namespace App\Demo\Application\Query;

interface CacheableQuery extends Query
{
    public function getHash(): string;

    public function getLifetime(): int;
}
