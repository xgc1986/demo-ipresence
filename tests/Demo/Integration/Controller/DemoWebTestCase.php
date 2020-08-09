<?php

declare(strict_types=1);

namespace App\Tests\Demo\Integration\Controller;

use Codeception\Util\JsonType;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DemoWebTestCase extends WebTestCase
{
    const ERROR_SKELETON = [
        'message' => 'string',
        'code' => 'integer'
    ];

    public static function assertJsonSkeleton(array $expected, string $value): void
    {
        $jsonType = new JsonType(json_decode($value, true));
        self::assertTrue($jsonType->matches($expected));
    }

    public static function assertErrorJsonSkeleton(string $value): void
    {
        $jsonType = new JsonType(json_decode($value, true));
        self::assertTrue($jsonType->matches(self::ERROR_SKELETON));
    }
}
