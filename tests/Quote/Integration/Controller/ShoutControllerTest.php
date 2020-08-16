<?php

declare(strict_types=1);

namespace App\Tests\Quote\Integration\Controller;

use App\Tests\Common\WebTestCase;

class ShoutControllerTest extends WebTestCase
{
    const QUOTES_SKELETON = ['string'];

    public function testReturnsListsOfShouts(): void
    {
        $client = static::createClient();
        $client->request('GET', '/shout/author-0');

        self::assertEquals(200, $client->getResponse()->getStatusCode());
        self::assertJsonSkeleton(self::QUOTES_SKELETON, $client->getResponse()->getContent());
    }

    public function testReturns400BecauseOutOfRangeLimit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/shout/author-0', [
            'limit' => 11
        ]);

        self::assertEquals(400, $client->getResponse()->getStatusCode());
        self::assertErrorJsonSkeleton($client->getResponse()->getContent());
    }

    public function testReturns400BecauseLimitIsNotAnInteger(): void
    {
        $client = static::createClient();
        $client->request('GET', '/shout/author-0', [
            'limit' => 'hola'
        ]);

        self::assertEquals(400, $client->getResponse()->getStatusCode());
        self::assertErrorJsonSkeleton($client->getResponse()->getContent());
    }

    public function testReturnsErrorIfFormatIsInvalid(): void
    {
        $client = static::createClient();
        $client->request('GET', '/shout/author-0', [
            'format' => 'INVALID_FORMAT'
        ]);
        self::assertEquals(400, $client->getResponse()->getStatusCode());
        self::assertErrorJsonSkeleton($client->getResponse()->getContent());
    }
}
