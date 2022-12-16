<?php


use App\Entity\User;
use App\EntityManager\EntityManager;
use App\Database\DBConnexion;
use App\Entity\Post;

require './vendor/autoload.php';



$db = new DBConnexion('src\Database\config.yml');
$em = new EntityManager($db::getConnexion());
$postsM = $em::getManager(Post::class);
$posts = $postsM->findAll();
// var_dump($posts);
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
// print_r($posts);

$posts = $em->findAll($post, ['content' => '%yes%']);
// print_r($posts);

$post = $posts[0];

echo gettype($post) . "\n";
// Todo : Implement this
echo "Author : $post->author \n";
//$post->Author->getLogin();
//$post->Author->findPost();
//$post->Author->findPost(['name' => '%here%']);

die;
