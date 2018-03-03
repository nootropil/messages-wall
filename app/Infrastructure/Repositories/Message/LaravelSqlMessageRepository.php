<?php
declare(strict_types = 1);

namespace App\Infrastructure\Repositories\Message;

use App\Domain\Models\Message;
use App\Domain\Repositories\Message\MessageRepository;
use App\Infrastructure\Service\IdentityGenerator\Uuid4Generator;
use Illuminate\Support\Facades\DB;


final class LaravelSqlMessageRepository implements MessageRepository
{
    const TABLE_NAME = 'emergency_voice_message';

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
     * @param Message $entity
     */
    public function add(Message $entity): void
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