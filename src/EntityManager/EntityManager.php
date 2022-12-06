<?php

namespace App\EntityManager;

use App\Entity\Entity;
use PDO;

class EntityManager
{


    /**
     * @param PDO $conn 
     * @return void 
     */
    public function __construct(public PDO $conn)
    {
    }

    public function save(Entity $entity): Entity|null
    {
        if (!$entity->id)
            return $this->create($entity);
        return $this->update($entity);
    }

    private function create(Entity $entity): Entity
    {
        // TODO : 
        $query = "INSERT INTO {$entity->getTable()} ($fields) VALUES ($values)";

        $this->conn->exec($query);
        $entity->id = $this->conn->lastInsertId();
        return $entity;
    }

    private function update(Entity $entity): Entity
    {
        // TODO :
        $query = "UPDATE {$entity->getTable()} SET ($field = $value) WHERE id = {$entity->id}";
        $this->conn->exec($query);
        $entity->id = $this->conn->lastInsertId();
        return $entity;
    }

    public function findById(string $className, int $id): Entity | bool
    {
        $entity = new $className();
        $query = "SELECT * FROM {$entity->getTable()} WHERE id = :id";
        $stm = $this->conn->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $className);
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }

    public function findOn()
    {
        # code...
    }

    public function remove(Entity $entity): bool|int
    {
        $query = "DELET FROM {$entity->getTable()} WHERE id = {$entity->id}";
        return $this->conn->exec($query);
    }
}
