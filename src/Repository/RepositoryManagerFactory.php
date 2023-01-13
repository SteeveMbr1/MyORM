<?php

namespace MyORM\Repository\RepositoryManagerFactory;

use MyORM\Entity\Entity;
use MyORM\Repository\RepositoryManager;
use PDO;

class RepositoryManagerFactory
{

    private static PDO $db;

    public static function init(PDO $db): static
    {
        self::$db = $db;
        return new static;
    }

    public static function getManager(string $manager): RepositoryManager|null
    {
        if (is_a(RepositoryManager::class, $manager, true)) {
            return new $manager(self::$db);
        }

        if (is_a(Entity::class, $manager, true)) {
            return new RepositoryManager(self::$db, $manager);
        }
        return null;
    }
}
