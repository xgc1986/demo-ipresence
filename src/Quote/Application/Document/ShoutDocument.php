<?php

declare(strict_types=1);

namespace App\Quote\Application\Document;

use App\Common\Service\Bus\Document;

class ShoutDocument implements Document
{
    private string $author;

    private string $shout;

    public function __construct(string $author, string $shout)
    {
        $this->author = $author;

        $this->shout = strtoupper($shout);

        if ($this->shout[strlen($this->shout) - 1] !== '!') {
            $this->shout .= '!';
        }
    }

    public function author(): string
    {
        return $this->author;
    }

    public function shout(): string
    {
        return $this->shout;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return $this->shout();
    }
}
