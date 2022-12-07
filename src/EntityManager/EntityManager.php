<?php

namespace App\EntityManager;

use App\Entity\Entity;
use PDO;
use PDOException;

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
        if (empty($entity->id))
            return $this->update($entity);
        return $this->create($entity);
    }

    private function create(Entity $entity): Entity
    {
        // TODO : 
        $modelfields = $entity->getModelFields();
        $fields = join(', ', array_keys($modelfields));
        $values = join(', :', array_keys($modelfields));
        $query = "INSERT INTO {$entity->getTable()} ($fields) VALUES (:$values)";


        $stmt = $this->conn->prepare($query);
        $stmt->execute($modelfields);
        $entity->id = $this->conn->lastInsertId();
        return $entity;
    }

    private function update(Entity $entity): Entity
    {
        // TODO :
        $modelfields = $entity->getModelFields();
        $set = "";
        foreach ($modelfields as $key => $v) {
            if ($key != 'id')
                $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $query = "UPDATE {$entity->getTable()} SET $set WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($modelfields);

        return $entity;
    }

    /**
     * 
     * @param string $className 
     * @param int $id 
     * @return Entity|bool 
     * @throws PDOException 
     */
    public function findById(string $className, int $id): Entity | bool
    {
        $entity = new $className();
        $query = "SELECT * FROM {$entity->getTable()} WHERE id = :id";
        $stm = $this->conn->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $className);
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }


    /**
     * 
     * @param Entity $entity 
     * @return array 
     * @throws PDOException 
     */
    public function findAll(Entity $entity, array $cond = []): array
    {
        if (empty($cond))
            $cond = $entity->getModelFields();
        $where = "";
        foreach ($cond as $key => $v) {
            $where .= "$key = :$key, ";
        }
        $where = rtrim($where, ', ');

        $query = "SELECT * FROM {$entity->getTable()} WHERE $where";
        $stm = $this->conn->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $entity::class);
        $stm->execute($cond);
        return $stm->fetchAll();
    }

    public function remove(Entity $entity): bool|int
    {
        $query = "DELET FROM {$entity->getTable()} WHERE id = {$entity->id}";
        return $this->conn->exec($query);
    }
}
