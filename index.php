<?php


use App\Entity\User;
use App\EntityManager\EntityManager;
use App\Database\DBConnexion;
use App\Entity\Post;

require './vendor/autoload.php';




$em = new EntityManager(DBConnexion::getConnexion());



$post = new Post();
$post->setName('First post')
     ->setContent('Here is the content')
     ->setCreatedAt((new DateTime())->format(DateTime::RFC7231))
     ->setIsOnline(false);

$user = new User();
$user->setLogin('log in')
     ->setPassword('My passWord');


var_dump($post->getModelFields());
var_dump($user->getModelFields());
die;
// CREATE new post in DB
// $em->save($post);



// READ post in DB
$post = $em->findById(Post::class, 3);
$post->setName('I change my mind')
     ->setContent('Here why it\'s append')
     ->setCreatedAt((new DateTime())->format(DateTime::RFC7231))
     ->setIsOnline(true);

// UPDATE post in DB
$em->save($post);

var_dump($post);
die;


// DELETE
$em->remove($post);
