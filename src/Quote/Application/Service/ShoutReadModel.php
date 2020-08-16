<?php

declare(strict_types=1);

namespace App\Quote\Application\Service;

use App\Quote\Application\Document\ShoutListDocument;
use App\Quote\Domain\AuthorSlug;
use App\Quote\Domain\Limit;

interface ShoutReadModel
{
    public function findByAuthor(AuthorSlug $author, Limit  $limit): ShoutListDocument;
}
