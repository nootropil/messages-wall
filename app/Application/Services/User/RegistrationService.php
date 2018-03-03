<?php
declare(strict_types=1);

namespace App\Application\Services\User;

use App\Domain\Models\User;
use App\Domain\Repositories\User\UserRepository;
use App\Domain\Services\User\RegistrationServiceInterface;

final class RegistrationService implements RegistrationServiceInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * RegistrationService constructor.
     * @param UserRepository $repository
     */
    public function __construct(
        UserRepository $repository

    )
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     */
    public function register(array $data): void
    {
        $userId = $this->repository->nextIdentity();
        $user = User::registerNew(
            $userId,
            $data['username'],
            $data['password']
        );
        $this->repository->add($user);
    }
}