<?php

use App\Database\DB;
use PHPUnit\Framework\TestCase;

final class DBTest extends TestCase
{

    public function test_get_default(): void
    {
        $db = DB::getConnexion();
        $this->assertEquals('sqlite:src\Database\store.db', $db);
    }

    public function test_get_sqlite(): void
    {
        $db = DB::getConnexion("SQLite");
        $this->assertEquals('sqlite:src\Database\store.db', $db);
    }

    public function test_get_mysql(): void
    {
        $db = DB::getConnexion("MySQL");
        $this->assertEquals('mysql:host=localhost;dbname=store_db;charset=utf8mb4, root, root', $db);
    }
}
