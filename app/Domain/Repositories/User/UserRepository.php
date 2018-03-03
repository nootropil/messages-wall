<?php
declare(strict_types=1);

namespace App\Domain\Repositories\User;

use App\Domain\Models\User;

interface UserRepository
{
    /**
     * @param User $model
     */
    public function add(User $model): void;

    /**
     * Get next id
     *
     * @return string
     */
    public function nextIdentity() : string;
}