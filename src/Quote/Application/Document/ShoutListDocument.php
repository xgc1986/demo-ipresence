<?php

declare(strict_types=1);

namespace App\Quote\Application\Document;

use App\Common\Service\Bus\Document;

class ShoutListDocument implements Document
{
    /**
     * @var ShoutDocument[]
     */
    private array $quotes;

    /**
     * @param ShoutDocument[] $quotes
     */
    public function __construct(array $quotes)
    {
        $this->quotes = $quotes;
    }

    /**
     * @return ShoutDocument[]
     */
    public function quotes(): array
    {
        return $this->quotes;
    }

    /**
     * @return string[]
     */
    public function serialize()
    {
        return array_map(fn(ShoutDocument $quote) => $quote->serialize(), $this->quotes);
    }
}
