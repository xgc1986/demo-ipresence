<?php

declare(strict_types=1);

namespace App\Common\Service\Bus;

interface Document
{
    /**
     * @return mixed
     */
    public function serialize();
}
