<?php

namespace App\EntityManager;

use App\Entity\Entity;
use PDO;

class EntityManager
{


    public function __construct(public PDO $conn)
    {
    }

    public function save(Entity $entity): Entity|null
    {
        if (!$entity->getId())
            return $this->create($entity);
        return $this->update($entity);
    }

    private function create(Entity $entity): Entity
    {
        $values = "";
        $fields = "";
        foreach ($entity->getFields() as $field) {
            if ($field == 'id')
                continue;
            $fields .= "'$field', ";
            $values .= "'{$entity->$field}', ";
        }
        $fields = rtrim($fields, ', ');
        $values = rtrim($values, ', ');
        $query = "INSERT INTO {$entity->getTable()} ($fields) VALUES ($values)";
        $this->conn->exec($query);
        return $entity->setId($this->conn->lastInsertId());
    }

    private function update(Entity $entity): Entity
    {
        $set = "";
        foreach ($entity->getFields() as $field) {
            if ($field == 'id')
                continue;
            $set .= "\"$field\" = \"{$entity->$field}\", ";
        }
        $set = rtrim($set, ', ');
        $query = "UPDATE {$entity->getTable()} SET $set WHERE id = {$entity->getId()}";
        $this->conn->exec($query);
        return $entity->setId($this->conn->lastInsertId());
    }

    public function findById(string $className, int $id): Entity
    {
        $entity = new $className();
        $query = "SELECT * FROM {$entity->getTable()} WHERE id = :id";
        $stm = $this->conn->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $className);
        $stm->execute(['id' => $id]);
        $res = $stm->fetchAll();
        var_dump($res);
        return $entity;
    }

    public function remove(Entity $entity): bool|int
    {
        $query = "DELET FROM {$entity->getTable()} WHERE id = {$entity->getId()}";
        return $this->conn->exec($query);
    }
}
