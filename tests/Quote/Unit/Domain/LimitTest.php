<?php

declare(strict_types=1);

namespace App\Tests\Quote\Unit\Domain;

use App\Quote\Domain\Exception\LimitOutOfRangeException;
use App\Quote\Domain\Limit;
use PHPUnit\Framework\TestCase;

class LimitTest extends TestCase
{
    public function testValidLimit(): void
    {
        $limit = new Limit(10);
        self::assertEquals(10, $limit->value());
    }

    public function testLimitExceedsMaximumValue(): void
    {
        self::expectException(LimitOutOfRangeException::class);
        new Limit(11);
    }

    public function testLimitExceedsMinimumValue(): void
    {
        self::expectException(LimitOutOfRangeException::class);
        new Limit(0);
    }
}
