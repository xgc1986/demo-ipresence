<?php

declare(strict_types=1);

namespace App\Demo\Domain\Exception;

use DomainException;

class LimitOutOfRangeException extends DomainException
{
    public function __construct(int $limit)
    {
        parent::__construct("Invalid limit '${limit}', limit must be greater than zero and less than or equal than 10");
    }
}
