<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\Message;

use App\Domain\Repositories\Message\MessageReadRepository;
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
        select 
            id,
            user_id,
            body
        from ' . LaravelSqlMessageRepository::TABLE_NAME . ' ORDER BY increment DESC');
        $rows = json_decode(json_encode($rows), true);

        return $rows;
    }



}