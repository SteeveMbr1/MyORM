<?php

use App\Entity\Post;
use App\Repository\PostsManager;
use MyORM\Database\DB;
use PHPUnit\Framework\TestCase;

final class PostsManagerTest extends TestCase
{
    protected PDO $db;

    public function setUp(): void
    {
        $this->db = DB::init('config\database.php')::getConnexion();
    }

    public function test_PostsManager_generateEntity()
    {
        $pm = new PostsManager($this->db);
        $this->assertEquals('App\Entity\Post', $pm->generateEntity());
    }

    public function test_PostsManager_generateTable()
    {
        $pm = new PostsManager($this->db);
        $this->assertEquals('Post', $pm->generateTable());
    }

    public function test_PostsManager_getEntity()
    {
        $pm = new PostsManager($this->db);
        $this->assertEquals('App\Entity\Post', $pm->getEntity());
    }

    public function test_PostsManager_getTable()
    {
        $pm = new PostsManager($this->db);
        $this->assertEquals('Post', $pm->getTable());
    }
    public function test_PostsManager_Modified()
    {
        $pm = new PostsManager($this->db, 'App\Entity\Posts', 'Article');
        $this->assertEquals('App\Entity\Posts', $pm->getEntity());
        $this->assertEquals('Article', $pm->getTable());
    }

    public function test_FindById()
    {
        $pm = new PostsManager($this->db);
        $post = $pm->findById(1);
        $this->assertEquals('Is 1 post', $post->title);
    }
}
