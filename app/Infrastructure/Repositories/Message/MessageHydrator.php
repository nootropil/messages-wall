<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\Message;

use App\Domain\Contract\Entity;
use App\Domain\Models\Message;
use App\Infrastructure\Repositories\HydratorInterface;
use function Zelenin\Hydrator\createObjectWithoutConstructor;
use Zelenin\Hydrator\NamingStrategy\UnderscoreToLowerCamelCaseNamingStrategy;
use Zelenin\Hydrator\Strategy\ReflectionStrategy;
use Zelenin\Hydrator\StrategyHydrator;

final class MessageHydrator implements HydratorInterface
{
    /**
     * @param array $columns
     * @return Entity
     */
    public function hydrate(array $columns): Entity
    {
        $hydrator = new StrategyHydrator(new ReflectionStrategy(), new UnderscoreToLowerCamelCaseNamingStrategy());
        /* @var $object Message */
        $object = createObjectWithoutConstructor(Message::class);
        $object = $hydrator->hydrate($object, $columns);

        return $object;
    }

    /**
     * @param $entity
     * @return array
     */
    public function extract($entity): array
    {
        /* @var $entity Message */
        $columns['user_id'] = $entity->getUserId();
        $columns['body'] = $entity->getBody();

        return $columns;
    }
}