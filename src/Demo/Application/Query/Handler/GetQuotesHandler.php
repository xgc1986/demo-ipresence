<?php

declare(strict_types=1);

namespace App\Demo\Application\Query\Handler;

use App\Demo\Application\Document\ShoutListDocument;
use App\Demo\Application\Query\GetShouts;
use App\Demo\Application\Service\ShoutReadModel;

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
