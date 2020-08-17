<?php

declare(strict_types=1);

namespace App\Tests\Quote\Unit\Application;

use App\Quote\Application\Document\ShoutDocument;
use PHPUnit\Framework\TestCase;

class ShoutDocumentTest extends TestCase
{
    public function testQuoteIsTransformedToShout(): void
    {
        $shout = new ShoutDocument('test', 'message');
        self::assertEquals('MESSAGE!', $shout->shout());
    }

    public function testQuoteIsTransformedToShoutWithPreviousExclamation(): void
    {
        $shout = new ShoutDocument('test', 'message!');
        self::assertEquals('MESSAGE!', $shout->shout());
    }
}
