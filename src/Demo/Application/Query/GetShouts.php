<?php

declare(strict_types=1);

namespace App\Demo\Application\Query;

use App\Common\Service\Bus\CacheableQuery;
use App\Demo\Domain\AuthorSlug;
use App\Demo\Domain\Limit;

class GetShouts implements CacheableQuery
{
    private AuthorSlug $author;

    private Limit $limit;

    public function __construct(string $author, int $limit)
    {
        $this->author = new AuthorSlug($author);
        $this->limit = new Limit($limit);
    }

    public function author(): AuthorSlug
    {
        return $this->author;
    }

    public function limit(): Limit
    {
        return $this->limit;
    }

    public function getHash(): string
    {
        return $this->author->value() . '_' . $this->limit()->value();
    }

    public function getLifetime(): int
    {
        // 5 minutes of lifetime
        return 300;
    }
}
