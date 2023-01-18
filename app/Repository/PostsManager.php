<?php


namespace App\Repository;

use App\Entity\Post;
use MyORM\Repository\RepositoryManager;

class PostsManager extends RepositoryManager
{
    protected ?string $table     = 'Post';
    protected ?string $entity    = Post::class;
}
