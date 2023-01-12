<?php

namespace MyORM\Repository;

use MyORM\Traits\ClassTrait;
use PDO;

class RepositoryManager
{
    use ClassTrait;

    public function __construct(
        protected PDO $db,
        protected string $table = '',
        protected string $entity = ''
    ) {
        if ($this->entity !== '')
            $this->entity = $this->generateEntity();
    }

    public function generateEntity()
    {
        if (isset($this->entity))
            $entity = $this->entity;
        $entity = str_replace('Manager', '', static::class);
        $entity = rtrim($entity, 's');
        $entity = str_replace('Repository\\', 'Entity\\', $entity);
        return $entity;
    }

    public function generateTable()
    {
        if (isset($this->table))
            $table = $this->table;
        $table = str_replace('Manager', '', static::class());
        $table = rtrim($table, 's');
        return $table;
    }

    public function findById(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stm = $this->db->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $this->entity::class);
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }
}
