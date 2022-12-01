<?php

use App\Entity\Entity;
use App\Entity\User;
use App\EntityManager\EntityManager;

require './vendor/autoload.php';


$user = new User(1);


$user->setLogin('admin')
     ->setPassword('p@ss');

     
var_dump (EntityManager::find($user));
