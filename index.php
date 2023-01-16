<?php

use MyORM\Database\DB;

require './vendor/autoload.php';

new DB('config\database.php');

$db = DB::getConnexion();

$stm = $db->query("SELECT 'Hello world'");

print_r($stm->fetchColumn());
