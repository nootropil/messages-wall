<?php

namespace App\Application\Adapters\User;

use App\Domain\Models\User as DomainUser;
use Illuminate\Contracts\Auth\Authenticatable;

class UserAdapter implements Authenticatable
{
    /**
     * @var DomainUser
     */
    private $user;

    /**
     * @var bool
     */
    private $rememberToken;

    /**
     * User constructor.
     * @param DomainUser $user
     */
    public function __construct(DomainUser $user)
    {
        $this->user = $user;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->user->getUsername();
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->user->getId();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->user->getPasswordHash();
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * @param bool $value
     */
    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember';
    }
}
