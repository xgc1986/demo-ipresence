<?php

declare(strict_types=1);

namespace App\Tests\Demo\Functional;

use App\Demo\Application\Query\GetShouts;
use App\Common\Service\Bus;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GetQuotesTest extends KernelTestCase
{
    /**
     * @throws Exception
     */
    public function testGetQuotes(): void
    {
        self::bootKernel();
        $bus = self::$container->get(Bus::class);
        $doc = $bus->dispatchQuery(new GetShouts('author-0', 2));

        self::assertEquals([
            'QUOTE 0!',
            'QUOTE 1!'
        ], $doc->serialize());
    }

    /**
     * @throws Exception
     */
    public function testCanGetAnyQuotes(): void
    {
        $container = self::bootKernel()->getContainer();
        $bus = $container->get(Bus::class);
        $doc = $bus->dispatchQuery(new GetShouts('NO_AUTHOR', 2));

        self::assertEquals([], $doc->serialize());
    }
}
