<?php
declare(strict_types=1);

namespace App\Domain\Repositories\User;

use App\Domain\Models\User;

interface UserReadRepository
{
    /**
     * @param string $username
     * @return bool
     */
    public function existsByUsername(string $username): bool;

    /**
     * @param string $id
     * @return User|null
     */
    public function fetchByUsername(string $id): ?User;
}