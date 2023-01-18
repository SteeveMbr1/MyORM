<?php

use App\Entity\User;
use App\Repository\UsersManager;
use MyORM\Database\DB;
use PHPUnit\Framework\TestCase;

final class UsersManagerTest extends TestCase
{
    protected PDO $db;

    public function setUp(): void
    {
        $this->db = DB::init('config\database.php')::getConnexion();
    }

    public function test_UserManager_generateEntity()
    {
        $um = new UsersManager($this->db);
        $this->assertEquals('App\Entity\User', $um->generateEntity());
    }

    public function test_UserManager_generateTable()
    {
        $um = new UsersManager($this->db);
        $this->assertEquals('User', $um->generateTable());
    }

    public function test_UserManager_getEntity()
    {
        $um = new UsersManager($this->db);
        $this->assertEquals('App\Entity\User', $um->getEntity());
    }

    public function test_UserManager_getTable()
    {
        $um = new UsersManager($this->db);
        $this->assertEquals('User', $um->getTable());
    }

    public function test_UserManager_Modified()
    {
        $um = new UsersManager($this->db, 'App\Models\User', 'Users_');
        $this->assertEquals('App\Models\User', $um->getEntity());
        $this->assertEquals('Users_', $um->getTable());
    }

    public function test_FindById()
    {
        $um = new UsersManager($this->db);
        $user = $um->findById(1);
        $this->assertEquals('NewPasWord', $user->password);
    }
}
