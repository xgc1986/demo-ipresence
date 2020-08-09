<?php

declare(strict_types=1);

namespace App\Demo\Application\Document;

interface Document
{
    /**
     * @return mixed
     */
    public function serialize();
}
