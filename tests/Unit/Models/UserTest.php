<?php

namespace Tests\Unit;

use App\Domain\Models\User;
use Tests\TestCase;
use function Zelenin\Hydrator\createObjectWithoutConstructor;
use Zelenin\Hydrator\StrategyHydrator;
use Zelenin\Hydrator\Strategy\ReflectionStrategy;
use Zelenin\Hydrator\NamingStrategy\RawNamingStrategy;

class UserTest extends TestCase
{
    private const USER_DATA = [
        'id' => 'f45de050-5a45-4440-b5cb-dac81e666ac4',
        'passwordHash' => '$2y$10$Wx0joQ47v3VDpKeakV.oBObVd5VPHrFyM5I2ZXqP.JCRnrLabbWYq', //1234Qw
        'username' => 'qwertyui',
        'rememberToken' => 'asdfasdfasdf3er23f',
    ];

    /**
     * @var User
     */
    private $user;

    /**
     * @return void
     */
    public function setUp()
    {
        $hydrator = new StrategyHydrator(new ReflectionStrategy(), new RawNamingStrategy());
        /* @var $object \App\Domain\Models\User */
        $object = createObjectWithoutConstructor(User::class);
        $object = $hydrator->hydrate($object, self::USER_DATA);
        $this->user = $object;

        parent::setUp();
    }


    /**
     * Тест всех геттеров
     * @return void
     */
    public function testGetters()
    {
        $this->assertTrue($this->user->getId() === self::USER_DATA['id']);
        $this->assertTrue($this->user->getPasswordHash() === self::USER_DATA['passwordHash']);
        $this->assertTrue($this->user->getUsername() === self::USER_DATA['username']);
        $this->assertTrue($this->user->getRememberToken() === self::USER_DATA['rememberToken']);
    }

    /**
     * Тестируем корректность создания экземпляра юзера при регистрации
     * @return void
     */
    public function testRegisterNew()
    {
        $newUser = User::registerNew(
            self::USER_DATA['id'],
            self::USER_DATA['username'],
            '123'
        );
        $this->assertTrue($this->user->getId() === $newUser->getId());
        $this->assertTrue($this->user->getUsername() === $newUser->getUsername());
        $this->assertTrue($this->user->getPasswordHash() !== null);
    }


}
