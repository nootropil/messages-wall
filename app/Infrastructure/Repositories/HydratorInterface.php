<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Contract\Entity;

interface HydratorInterface
{
    /**
     * @param array $columns
     * @return Entity
     */
    public function hydrate(array $columns): Entity;

    /**
     * @param $entity
     * @return array
     */
    public function extract($entity): array;
}