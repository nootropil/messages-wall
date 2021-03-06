<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\User;

use App\Domain\Models\User;
use App\Domain\Repositories\User\UserReadRepository;
use Illuminate\Support\Facades\DB;

final class LaravelSqlUserReadRepository implements UserReadRepository
{
    /**
     * @var UserHydrator
     */
    private $hydrator;

    /**
     * YiiSqlUserReadRepository constructor.
     */
    public function __construct()
    {
        $this->hydrator = new UserHydrator();
    }

    /**
     * Получить пользователя по имени
     *
     * @param string $username
     * @return User|null
     */
    public function fetchByUsername(string $username): ?User
    {
        $row = DB::selectOne('SELECT * FROM ' . LaravelSqlUserRepository::TABLE_NAME . ' WHERE username = :username', ['username' => $username]);
        if ($row) {
            $row = json_decode(json_encode($row), true);

            return $this->toEntity($row);
        } else {
            return null;
        }
    }

    /**
     * Проверить существование пользователя по имени
     *
     * @param string $username
     * @return bool
     */
    public function existsByUsername(string $username): bool
    {
        $row = DB::selectOne('SELECT * FROM ' . LaravelSqlUserRepository::TABLE_NAME . ' WHERE username = :username', ['username' => $username]);

        return !empty($row);
    }

    /**
     * @param $result
     * @return User
     */
    private function toEntity(array $result): User
    {
        return $this->hydrator->hydrate($result);
    }


}