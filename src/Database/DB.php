<?php

namespace MyORM\Database;

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

    static public function init(string $config_file): static
    {
        self::$connexions = [];
        self::$config = require $config_file;
        return new static;
    }

    static public function getConnexion(string $name = 'default')
    {
        if ($name == 'default')
            $name = self::$config['default'];

        if (!isset(self::$config[$name]))
            throw new \Exception("Error: The '$name' connexion does not exist", 1);

        isset(self::$connexions[$name]) || self::newConnexion($name);
        return self::$connexions[$name];
    }

    static private function newConnexion(string $name): void
    {

        $connexion = match (self::$config[$name]['driver']) {
            'sqlite' => self::load_sqlite_connexion(self::$config[$name]),
            'mysql'  => self::load_mysql_connexion(self::$config[$name]),
        };

        self::$connexions[$name] = $connexion;
    }

    private static function load_sqlite_connexion(array $config)
    {
        return new PDO("sqlite:" . $config['file']);
    }

    private static function load_mysql_connexion(array $config)
    {
        $host = $config['host'];
        $dbname = $config['dbname'];
        $username = $config['username'];
        $password = $config['password'];
        return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    }
}
