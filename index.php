<?php

use App\Repository\UsersManager;
use MyORM\Database\DB;

require './vendor/autoload.php';

new DB('config\database.php');

$db = DB::getConnexion();

$um = new UsersManager($db);

var_dump($um);
