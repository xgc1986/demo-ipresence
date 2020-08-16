<?php
declare(strict_types=1);

namespace App\Tests\Quote\Unit\Domain;

use App\Quote\Domain\AuthorSlug;
use PHPUnit\Framework\TestCase;

class AuthorSlugTest extends TestCase
{
    public function testValidConversion(): void
    {
        $author = new AuthorSlug('Javier González');
        self::assertEquals('javier-gonzalez', $author->value());
    }

    public function testValidConversionWithEmoji(): void
    {
        $author = new AuthorSlug('Javier González 💩');
        self::assertEquals('javier-gonzalez-💩', $author->value());
    }

    public function testValidConversionWithNumbers(): void
    {
        $author = new AuthorSlug('author0');
        self::assertEquals('author0', $author->value());
    }
}
