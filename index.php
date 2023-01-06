<?php


use App\Entity\User;
use App\EntityManager\EntityManager;
use App\Database\DB;
use App\Entity\Post;

require './vendor/autoload.php';

$db = DB::getConnexion();
$em = new EntityManager($db);

$pm = $em::getManager(Post::class);
$posts = $pm->findAll();
var_dump($posts);

$post = $posts[0];

var_dump($post->Author->id);

die;


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
