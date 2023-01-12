<?php


namespace App\Repository;

use App\Entity\User;
use MyORM\Repository\RepositoryManager;
use PDO;

class UsersManager extends RepositoryManager
{
    protected string $table = 'User_';

    public function __construct(protected PDO $db)
    {
    }
}
