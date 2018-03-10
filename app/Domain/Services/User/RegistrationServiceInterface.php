<?php
declare(strict_types=1);

namespace App\Domain\Services\User;

interface RegistrationServiceInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function register(array $data): void;
}