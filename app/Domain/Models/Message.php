<?php
declare(strict_types=1);

namespace App\Domain\Models;


final class Message
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $body;

    /**
     * @var int
     */
    private $increment;

    /**
     * Message constructor.
     * @param string $id
     * @param string $userId
     * @param string $body
     */
    public function __construct(
        string $id,
        string $userId,
        string $body
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->body = $body;
    }

    /**
     * @param string $id
     * @param string $userId
     * @param string $body
     * @return Message
     */
    public static function createNew(
        string $id,
        string $userId,
        string $body
    ): self
    {
        return new self($id, $userId, $body);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getIncrement(): int
    {
        return $this->increment;
    }
}