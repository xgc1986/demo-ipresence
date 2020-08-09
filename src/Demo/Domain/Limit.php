<?php

declare(strict_types=1);

namespace App\Demo\Domain;

use App\Demo\Domain\Exception\LimitOutOfRangeException;

class Limit
{
    private int $value;

    public function __construct(int $value)
    {
        self::check($value);
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    private static function check(int $value): void
    {
        if ($value <= 0 || $value > 10) {
            throw new LimitOutOfRangeException($value);
        }
    }
}
