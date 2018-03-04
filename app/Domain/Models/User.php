<?php
declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Contract\Entity;

final class User implements Entity
{
    /**
     * @var string
     */
    private $id;   

    /**
     * @var string|null
     */
    private $passwordHash;

    /**
     * @var string
     */
    private $username;

    /**
     * User constructor.
     * @param string $id
     * @param null|string $passwordHash
     * @param string $username
     */
    private function __construct(
        string $id,
        ?string $passwordHash,
        string $username

    )
    {
        $this->id = $id;
        $this->passwordHash = $passwordHash;
        $this->username = $username;
    }

    /**
     * @param string $id
     * @param string $password
     * @param string $username
     * @return User
     */
    public static function registerNew(
        string $id,
        string $username,
        string $password
    ): self
    {
        $user =  new self(
            $id,
            password_hash($password, PASSWORD_DEFAULT),
            $username
        );

        return $user;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}