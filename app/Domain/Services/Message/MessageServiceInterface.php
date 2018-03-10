<?php
declare(strict_types=1);

namespace App\Domain\Services\Message;

interface MessageServiceInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void;
}