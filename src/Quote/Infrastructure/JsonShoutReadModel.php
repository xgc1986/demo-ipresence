<?php

declare(strict_types=1);

namespace App\Quote\Infrastructure;

use App\Quote\Application\Document\ShoutDocument;
use App\Quote\Application\Document\ShoutListDocument;
use App\Quote\Application\Service\ShoutReadModel;
use App\Quote\Domain\AuthorSlug;
use App\Quote\Domain\Limit;
use Exception;
use Symfony\Component\Stopwatch\Stopwatch;

class JsonShoutReadModel implements ShoutReadModel
{
    private string $jsonFile;

    private Stopwatch $stopwatch;

    public function __construct(string $jsonFile, Stopwatch $stopwatch)
    {
        $this->jsonFile = $jsonFile;
        $this->stopwatch = $stopwatch;
    }

    /**
     * @throws Exception
     */
    public function findByAuthor(AuthorSlug $author, Limit $limit): ShoutListDocument
    {
        $this->stopwatch->start(__METHOD__);
        $quotes = $this->loadQuotes();

        $filtered = array_slice(array_values(array_filter(
            $quotes->quotes(),
            fn(ShoutDocument $quote) => $author->compare(new AuthorSlug($quote->author())) === 0
        )), 0, $limit->value());

        $this->stopwatch->stop(__METHOD__);
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
