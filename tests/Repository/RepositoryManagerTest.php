<?php

use App\Repository\PostsManager;
use App\Repository\UsersManager;
use MyORM\Database\DB;
use MyORM\Repository\RepositoryManager;
use PHPUnit\Framework\TestCase;

final class RepositoryManagerTest extends TestCase
{
    protected PDO $db;

    public function setUp(): void
    {
        $this->db = DB::init('config\database.php')::getConnexion();
    }

    public function test_RepositoryManager_generateEntity()
    {
        $rm = new RepositoryManager($this->db);
        $this->assertEquals('MyORM\Entity\Repository', $rm->generateEntity());
    }


    public function test_RepositoryManager_generateTable()
    {
        $rm = new RepositoryManager($this->db);
        $this->assertEquals('Repository', $rm->generateTable());
    }

    public function test_PostsManager_generateEntity()
    {
        $pm = new PostsManager($this->db);
        $this->assertEquals('App\Entity\Post', $pm->generateEntity());
    }
}
