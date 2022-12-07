<?php


use App\Entity\User;
use App\EntityManager\EntityManager;
use App\Database\DBConnexion;
use App\Entity\Post;

require './vendor/autoload.php';




$em = new EntityManager(DBConnexion::getConnexion());



$post = new Post();
$post->setName('Are you ready ?!')
     ->setContent('Every body  !!!')
     ->setCreatedAt((new DateTime())->format(DateTime::RFC7231))
     ->setIsOnline(true);

$user = new User();
$user->setLogin('log in')
     ->setPassword('My passWord');


// CREATE new post in DB
//$em->save($post);


// READ post in DB
$post = $em->findById(Post::class, 12);

$post->setName('I change all')
     ->setContent('Here why it\'s append again')
     ->setCreatedAt((new DateTime())->format(DateTime::RFC7231))
     ->setIsOnline(true);

$pts = new Post;
$pts->setIsOnline(true);

// To do : search with condition
$posts = $em->findAll($pts);
var_dump($posts);
die;
// UPDATE post in DB
$em->save($post);



// DELETE
$em->remove($post);
