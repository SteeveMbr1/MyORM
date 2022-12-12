<?php


namespace App\EntityManager;

use App\Entity\Entity;
use App\Entity\Post;

class PostsManager extends EntityManager
{

    public function findAll(Entity|string $entity = Post::class, array $cond = []): array
    {
        return parent::findAll($entity, $cond);
    }

    public function findById(string $entity = Post::class, int $id): Entity|bool
    {
        return parent::findById($entity, $id);
    }
}
