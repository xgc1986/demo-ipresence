<?php

declare(strict_types=1);

namespace App\Quote\Domain;

use App\Quote\Domain\Exception\CannotSlugifyException;

class AuthorSlug
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = self::fixValue($value);
    }

    private static function fixValue(string $value): string
    {
        $slug = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [:Nonspacing Mark:] Remove; Lower();',
            $value
        );

        if (!is_string($slug)) {
            throw new CannotSlugifyException($value);
        }

        return preg_replace('/[-\s]+/', '-', $slug) ?? $slug; // remove consecutive spaces
    }

    public function value(): string
    {
        return $this->value;
    }

    public function compare(AuthorSlug $other): int
    {
        return strcmp($this->value(), $other->value());
    }
}
