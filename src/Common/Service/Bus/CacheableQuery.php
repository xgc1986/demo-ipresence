<?php

declare(strict_types=1);

namespace App\Common\Service\Bus;

interface CacheableQuery extends Query
{
    public function getHash(): string;

    public function getLifetime(): int;
}
