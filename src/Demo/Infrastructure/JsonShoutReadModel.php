<?php

declare(strict_types=1);

namespace App\Demo\Infrastructure;

use App\Demo\Application\Document\ShoutDocument;
use App\Demo\Application\Document\ShoutListDocument;
use App\Demo\Application\Service\ShoutReadModel;
use App\Demo\Domain\AuthorSlug;
use App\Demo\Domain\Limit;
use Exception;

class JsonShoutReadModel implements ShoutReadModel
{
    private string $jsonFile;

    public function __construct(string $jsonFile)
    {
        $this->jsonFile = $jsonFile;
    }

    /**
     * @throws Exception
     */
    public function findByAuthor(AuthorSlug $author, Limit $limit): ShoutListDocument
    {
        $quotes = $this->loadQuotes();

        $filtered = array_slice(array_values(array_filter(
            $quotes->quotes(),
            fn(ShoutDocument $quote) => $author->compare(new AuthorSlug($quote->author())) === 0
        )), 0, $limit->value());

        return new ShoutListDocument($filtered);
    }

    /**
     * @return ShoutListDocument
     * @throws Exception
     */
    private function loadQuotes(): ShoutListDocument
    {
        $data = file_get_contents($this->jsonFile);

        if ($data === false) {
            throw new Exception("Cannot read " . $this->jsonFile);
        }

        $docs = array_map(
            fn($item) => new ShoutDocument($item['author'], $item['quote']),
            json_decode($data, true, JSON_THROW_ON_ERROR)['quotes']
        );

        return new ShoutListDocument($docs);
    }
}
