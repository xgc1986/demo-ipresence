<?php

declare(strict_types=1);

namespace App\Demo\Infrastructure;

use App\Demo\Application\Document\ShoutDocument;
use App\Demo\Application\Document\ShoutListDocument;
use App\Demo\Application\Service\ShoutReadModel;
use App\Demo\Domain\AuthorSlug;
use App\Demo\Domain\Limit;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TheySaidSoShoutReadModel implements ShoutReadModel
{
    private HttpClientInterface $client;

    private string $apiKey;

    public function __construct(HttpClientInterface $client, string $theySaidSoApiKey)
    {
        $this->client = $client;

        $this->apiKey = $theySaidSoApiKey;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function findByAuthor(AuthorSlug $author, Limit $limit): ShoutListDocument
    {
        try {
            $response = $this->client->request(
                'GET',
                'http://quotes.rest/quote/search.json?author=',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-TheySaidSo-Api-Secret' => $this->apiKey
                    ],
                    'query' => [
                        'author' => str_replace('-', ' ', $author->value()),
                        'limit' => $limit->value()
                    ]
                ]
            );

            $rawData = json_decode($response->getContent(), true, JSON_THROW_ON_ERROR);
            $docs = array_slice(array_map(
                fn($item) => new ShoutDocument($item['author'], $item['quote']),
                $rawData['contents']['quotes']
            ), 0, $limit->value());

            return new ShoutListDocument($docs);
        } catch (ClientExceptionInterface $exception) {
            if ($exception->getCode() === 404) {
                return new ShoutListDocument([]);
            }

            throw $exception;
        }
    }
}
