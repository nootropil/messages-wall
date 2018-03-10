<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\Message;

use App\Domain\Repositories\Message\MessageReadRepository;
use App\Infrastructure\Repositories\User\LaravelSqlUserRepository;
use Illuminate\Support\Facades\DB;

final class LaravelSqlMessageReadRepository implements MessageReadRepository
{
    /**
     * @var MessageHydrator
     */
    private $hydrator;

    /**
     * YiiSqlMessageReadRepository constructor.
     */
    public function __construct()
    {
        $this->hydrator = new MessageHydrator();
    }

    /**
     * @return array
     */
    public function fetchAllAsArrayWithUsername(): array
    {
        $rows = DB::select('
        SELECT
            username,
            body
        FROM ' . LaravelSqlMessageRepository::TABLE_NAME . ' m 
        INNER JOIN '. LaravelSqlUserRepository::TABLE_NAME .' u 
            ON m.user_id = u.id 
        ORDER BY increment DESC');
        $rows = json_decode(json_encode($rows), true);

        return $rows;
    }



}