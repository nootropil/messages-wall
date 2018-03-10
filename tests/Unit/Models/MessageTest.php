<?php

namespace Tests\Unit;

use App\Domain\Models\Message;
use App\Domain\Models\User;
use Tests\TestCase;
use function Zelenin\Hydrator\createObjectWithoutConstructor;
use Zelenin\Hydrator\StrategyHydrator;
use Zelenin\Hydrator\Strategy\ReflectionStrategy;
use Zelenin\Hydrator\NamingStrategy\RawNamingStrategy;

class MessageTest extends TestCase
{
    private const MESSAGE_DATA = [
        'id' => 'bf5f4fa5-004d-4f72-ad79-4d86400be5f3',
        'userId' => 'f45de050-5a45-4440-b5cb-dac81e666ac4',
        'body' => 'asdfasdfsdfasdfasdfsdf',
    ];

    /**
     * @var Message
     */
    private $message;

    /**
     * @return void
     */
    public function setUp()
    {
        $hydrator = new StrategyHydrator(new ReflectionStrategy(), new RawNamingStrategy());
        /* @var $object \App\Domain\Models\Message */
        $object = createObjectWithoutConstructor(Message::class);
        $object = $hydrator->hydrate($object, self::MESSAGE_DATA);
        $this->message = $object;

        parent::setUp();
    }


    /**
     * Тест всех геттеров
     * @return void
     */
    public function testGetters()
    {
        $this->assertTrue($this->message->getId() === self::MESSAGE_DATA['id']);
        $this->assertTrue($this->message->getUserId() === self::MESSAGE_DATA['userId']);
        $this->assertTrue($this->message->getBody() === self::MESSAGE_DATA['body']);
    }

    /**
     * Тестируем корректность создания экземпляра юзера при регистрации
     * @return void
     */
    public function testRegisterNew()
    {
        $newMessage = Message::createNew(
            self::MESSAGE_DATA['id'],
            self::MESSAGE_DATA['userId'],
            self::MESSAGE_DATA['body']
        );
        $this->assertTrue($this->message == $newMessage);
    }


}
