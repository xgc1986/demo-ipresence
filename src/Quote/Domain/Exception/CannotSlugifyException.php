<?php

declare(strict_types=1);

namespace App\Quote\Domain\Exception;

use DomainException;

class CannotSlugifyException extends DomainException
{
    public function __construct(string $value)
    {
        parent::__construct("'${value}' cannot be converted to a slug string.");
    }
}
