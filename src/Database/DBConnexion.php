<?php

namespace App\Database;

use PDO;


class DBConnexion
{
    /**
     * array of PDO Connexions
     * @var PDO[]
     */
    static protected array $conn;

    /** @return void  */
    public function __construct(
        protected string $config_file_path = 'src/config/db_config.yml',
        protected string $config_name = 'default'
    ) {
        $config = yaml_parse_file($config_file_path);
        $config = $config['Database'][$config_name];


        //self::$conn = new PDO("sqlite:src/Database/store.db");
    }

    static public function getConnexion(array|string $config = 'default'): PDO
    {
        if (is_array($config))
            return self::load_from_array($config);
        return self::load_from_file($config);
    }

    static private function load_from_array($config)
    {
        $type = key($config);
        $get_pdo = "get_" . $type . "_PDO";
        return self::$get_pdo($config[$type]);
    }
}



DBConnexion::getConnexion();
DBConnexion::getConnexion('user_db');
DBConnexion::getConnexion($config['Database']);
