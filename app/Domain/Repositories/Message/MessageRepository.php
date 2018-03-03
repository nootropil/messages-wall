<?php
declare(strict_types=1);

namespace App\Domain\Repositories\Message;

use App\Domain\Models\Message;

interface MessageRepository
{
    /**
     * @param Message $model
     */
    public function add(Message $model): void;

    /**
     * Get next id
     *
     * @return string
     */
    public function nextIdentity() : string;
}