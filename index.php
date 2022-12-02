<?php


use App\Entity\User;
use App\EntityManager\EntityManager;
use App\Database\DBConnexion;

require './vendor/autoload.php';




$em = new EntityManager(DBConnexion::getConnexion());



$user = new User();
$user->setLogin('admin')
     ->setPassword('P@ssWord');


// CREATE new user in DB
$em->save($user);


// READ user in DB
$user = $em->findById(User::class, 1);


// UPDATE user in DB
$em->save($user);


// DELETE
$em->remove($user);
