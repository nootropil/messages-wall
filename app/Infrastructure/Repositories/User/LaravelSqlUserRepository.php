<?php
declare(strict_types = 1);

namespace App\Infrastructure\Repositories\User;

use App\Domain\Models\User;
use App\Domain\Repositories\User\UserRepository;
use App\Infrastructure\Service\IdentityGenerator\Uuid4Generator;
use Illuminate\Support\Facades\DB;

final class LaravelSqlUserRepository implements UserRepository
{
    const TABLE_NAME = 'public.user';

    /**
     * @var UserHydrator
     */
    private $hydrator;

    /**
     * LumenUserRepository constructor.
     */
    public function __construct()
    {
        $this->hydrator = new UserHydrator();
    }

    /**
     * @param User $entity
     */
    public function add(User $entity): void
    {
        $columns = $this->hydrator->extract($entity);
        $columns['id'] = $entity->getId();
        DB::table(self::TABLE_NAME)->insert($columns);
    }

    /**
     * Get next id
     *
     * @return string
     */
    public function nextIdentity() : string
    {
        $uuidGenerator = new Uuid4Generator();
        return $uuidGenerator->generate();
    }  
}