<?php

declare(strict_types=1);

namespace App\Tests\Common\Service;

use App\Common\Service\Cache;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;

class CacheTest extends TestCase
{
    public function testWorksCorrectly(): void
    {
        $cache = new Cache();
        $cache->save('test', 123, 60);

        self::assertEquals(123, $cache->get('test'));

        $cache->delete('test');

        self::assertNull($cache->get('test'));
    }

    public function testClearCache(): void
    {
        $cache = new Cache();
        $cache->save('test', 123, 60);
        $cache->clear();

        self::assertNull($cache->get('test'));
    }

    public function testIsNullIfDoesNotExist(): void
    {
        $cache = new Cache();

        self::assertNull($cache->get('test'));
    }
}
