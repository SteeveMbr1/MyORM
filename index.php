<?php


use App\Entity\User;
use App\EntityManager\EntityManager;
use App\Database\DBConnexion;
use App\Entity\Post;

require './vendor/autoload.php';




$em = new EntityManager(DBConnexion::getConnexion());


$user = $em->findById(User::class, 15);
print_r($user);

$users = $em->findAll('App\Entity\User');
print_r($users);

$users = $em->findAll('App\Entity\User', ['id' => 1]);
print_r($users);

$posts = $em->findAll('App\Entity\Post', ['content' => '%here%']);
print_r($posts);

$post = new Post;
$post->setTitle('%you%');

$posts = $em->findAll($post);
print_r($posts);

$posts = $em->findAll($post, ['content' => '%yes%']);
print_r($posts);

$post = $posts[0];
// Todo : Implement this
//$post->Author->getLogin();
//$post->Author->findPost();
//$post->Author->findPost(['name' => '%here%']);

die;
