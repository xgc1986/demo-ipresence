<?php

declare(strict_types=1);

namespace App\Demo\Application\Service;

use App\Demo\Application\Document\ShoutListDocument;
use App\Demo\Domain\AuthorSlug;
use App\Demo\Domain\Limit;

interface ShoutReadModel
{
    public function findByAuthor(AuthorSlug $author, Limit  $limit): ShoutListDocument;
}
