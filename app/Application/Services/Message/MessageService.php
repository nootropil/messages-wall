<?php
declare(strict_types=1);

namespace App\Application\Services\Message;

use App\Domain\Models\Message;
use App\Domain\Repositories\Message\MessageRepository;
use App\Domain\Services\Message\MessageServiceInterface;

final class MessageService implements MessageServiceInterface
{
    /**
     * @var MessageRepository
     */
    private $repository;


    /**
     * MessageService constructor.
     * @param MessageRepository $repository
     */
    public function __construct(
        MessageRepository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * Создание нового сообщения
     * array['userId'] id пользователя
     * array['body'] сообщение
     *
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $messageId = $this->repository->nextIdentity();
        $message = Message::createNew(
            $messageId,
            $data['userId'],
            $data['body']
        );
        $this->repository->add($message);
    }
}