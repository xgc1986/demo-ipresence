<?php

declare(strict_types=1);

namespace App\Quote\Application\Query\Handler;

use App\Quote\Application\Document\ShoutListDocument;
use App\Quote\Application\Query\GetShouts;
use App\Quote\Application\Service\ShoutReadModel;

class GetQuotesHandler
{
    private ShoutReadModel $readModel;

    public function __construct(ShoutReadModel $readModel)
    {
        $this->readModel = $readModel;
    }

    public function __invoke(GetShouts $query): ShoutListDocument
    {
        return $this->readModel->findByAuthor($query->author(), $query->limit());
    }
}
