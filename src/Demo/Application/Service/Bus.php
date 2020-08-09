<?php

declare(strict_types=1);

namespace App\Demo\Application\Service;

use App\Demo\Application\Document\Document;
use App\Demo\Application\Query\Query;

interface Bus
{
    public function dispatchQuery(Query $query): Document;
}
