<?php

use MyORM\Database\DB;
use PHPUnit\Framework\TestCase;

final class DBTest extends TestCase
{
    public PDO $db;

    public function setUp(): void
    {
        new DB('config\database.php');
        $this->db = DB::getConnexion();
    }

    public function test_connexion()
    {
        $stm = $this->db->query("SELECT 'Hello World'");
        $res = $stm->fetchColumn();
        $this->assertEquals('Hello World', $res);
    }
}
