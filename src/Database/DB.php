<?php

namespace App\Database;

use PDO;

class DB
{
    /**
     * array of PDO Connexions
     * @var PDO[]
     */
    protected static array $connexions;

    /**
     * Hold all the database configurations.
     * @var array
     */
    protected static array $config;


    static private function loadConfig(): void
    {
        if (empty(self::$config))
            self::$config = require_once '.\config\database.php';
    }

    static private function newConnexion(string $name): void
    {

        $connexion = match (self::$config[$name]['driver']) {
            'sqlite' => self::from_sqlite(self::$config[$name]),
            'mysql'  => self::from_mysql(self::$config[$name]),
        };

        self::$connexions[$name] = $connexion;
    }

    static public function getConnexion(string $name = 'default')
    {
        self::loadConfig();

        if ($name == 'default')
            $name = self::$config['default'];

        if (!isset(self::$config[$name]))
            throw new \Exception("Error the '$name' connexion does not exist", 1);

        isset(self::$connexions[$name]) || self::newConnexion($name);
        return self::$connexions[$name];
    }

    private static function from_sqlite(array $config)
    {
        return new PDO("sqlite:" . $config['file']);
    }

    private static function from_mysql(array $config)
    {
        $host = $config['host'];
        $dbname = $config['dbname'];
        $username = $config['username'];
        $password = $config['password'];
        return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    }
}
