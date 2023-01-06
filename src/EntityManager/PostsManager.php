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

    public function findOne(int $id = 0): Entity|bool
    {
        return parent::findById(Post::class, $id);
    }
}
