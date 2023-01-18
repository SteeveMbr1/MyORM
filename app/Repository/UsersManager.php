<?php


namespace App\Repository;

use App\Entity\User;
use MyORM\Repository\RepositoryManager;
use PDO;

class UsersManager extends RepositoryManager
{
    protected ?string $table  = 'User';
    protected ?string $entity = User::class;
}
