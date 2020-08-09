<?php

declare(strict_types=1);

namespace App\Tests\Demo\Unit\Infrastructure;

use App\Demo\Infrastructure\FilesystemCache;
use PHPUnit\Framework\TestCase;
use Psr\Cache\InvalidArgumentException;

class FileSystemCacheTest extends TestCase
{
    /**
     * @throws InvalidArgumentException
     */
    public function testWorksCorrectly(): void
    {
        $cache = new FilesystemCache();
        $cache->save('test', 123, 60);

        self::assertEquals(123, $cache->get('test'));

        $cache->delete('test');

        self::assertNull($cache->get('test'));
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testClearCache(): void
    {
        $cache = new FilesystemCache();
        $cache->save('test', 123, 60);
        $cache->clear();

        self::assertNull($cache->get('test'));
    }

    public function testIsNullIfDoesNotExist(): void
    {
        $cache = new FilesystemCache();

        self::assertNull($cache->get('test'));
    }
}
