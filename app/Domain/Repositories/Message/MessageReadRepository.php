<?php
declare(strict_types=1);

namespace App\Domain\Repositories\Message;

interface MessageReadRepository
{
    /**
     * @return array
     */
    public function fetchAllAsArrayWithUsername(): array;

}