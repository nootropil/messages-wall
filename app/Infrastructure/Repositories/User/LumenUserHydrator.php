<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories\User;

use App\Domain\Contract\Entity;
use App\Domain\Models\User;
use App\Infrastructure\Repositories\HydratorInterface;
use function Zelenin\Hydrator\createObjectWithoutConstructor;
use Zelenin\Hydrator\NamingStrategy\UnderscoreToLowerCamelCaseNamingStrategy;
use Zelenin\Hydrator\Strategy\ReflectionStrategy;
use Zelenin\Hydrator\StrategyHydrator;

final class UserHydrator implements HydratorInterface
{
    /**
     * @param array $columns
     * @return Entity
     */
    public function hydrate(array $columns): Entity
    {
        $hydrator = new StrategyHydrator(new ReflectionStrategy(), new UnderscoreToLowerCamelCaseNamingStrategy());
        /* @var $object User */
        $object = createObjectWithoutConstructor(User::class);
        $object = $hydrator->hydrate($object, $columns);

        return $object;
    }

    /**
     * @param $entity
     * @return array
     */
    public function extract($entity): array
    {
        /* @var $entity User */
        $hydrator = new StrategyHydrator(new ReflectionStrategy(), new UnderscoreToLowerCamelCaseNamingStrategy());
        $columns = $hydrator->extract($entity);

        return $columns;
    }
}