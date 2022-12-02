<?php

namespace App\Database;

use PDO;


class DBConnexion
{

    static protected PDO $conn;

    /** @return void  */
    public function __construct()
    {
        self::$conn = new PDO("sqlite:src/Database/store.db");
    }

    static public function getConnexion(): PDO
    {
        new static();
        return self::$conn;
    }
}
