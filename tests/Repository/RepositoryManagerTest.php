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

    public function test_generateEntity_RM()
    {
        $rm = new RepositoryManager($this->db);
        $this->assertEquals('MyORM\Entity\Repository', $rm->generateEntity());
    }


    public function test_generateTable_RM()
    {
        $rm = new RepositoryManager($this->db);
        $this->assertEquals('Repository', $rm->generateTable());
    }

    public function test_generateEntity_PM()
    {
        $pm = new PostsManager($this->db);
        $this->assertEquals('App\Entity\Post', $pm->generateEntity());
    }

    public function test_generateTable_PM()
    {
        $pm = new PostsManager($this->db);
        $this->assertEquals('Post', $pm->generateTable());
    }

    public function test_generateEntity_UM()
    {
        $um = new UsersManager($this->db);
        $this->assertEquals('App\Entity\User', $um->generateEntity());
    }

    public function test_generateTable_UM()
    {
        $um = new UsersManager($this->db);
        $this->assertEquals('User', $um->generateTable());
    }
}
