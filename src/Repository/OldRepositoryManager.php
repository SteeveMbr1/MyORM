<?php

namespace MyORM\Repository;

use MyORM\Entity\Entity;
use PDO;

use Exception;
use PDOException;

class OldRepositoryManager
{

    /**
     * @param PDO $db 
     * @return void 
     */
    public function __construct(
        protected PDO $db,
        protected string $table_name = ''
    ) {
    }

    public function save(Entity $entity): Entity|null
    {
        if (!empty($entity->id))
            return $this->update($entity);
        return $this->create($entity);
    }

    /**
     * @param Entity $entity 
     * @return Entity 
     * @throws PDOException 
     */
    private function create(Entity $entity): Entity
    {
        // TODO : 
        $modelfields = $entity->getModelFields();
        $fields = join(', ', array_keys($modelfields));
        $values = join(', :', array_keys($modelfields));
        $query = "INSERT INTO {$entity::getTable()} ($fields) VALUES (:$values)";


        $stmt = $this->db->prepare($query);
        $stmt->execute($modelfields);
        $entity->id = $this->db->lastInsertId();
        return $entity;
    }

    /**
     * @param Entity $entity 
     * @return Entity 
     * @throws PDOException 
     */
    private function update(Entity $entity): Entity
    {
        $modelfields = $entity->getModelFields();
        $set = "";
        foreach ($modelfields as $key => $value) {
            if ($key != 'id')
                $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $query = "UPDATE {$entity->getTable()} SET $set WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute($modelfields);

        return $entity;
    }

    /**
     * 
     * @param string $entity must be an Entity inherited class
     * @param int $id 
     * @return Entity|bool 
     * @throws Exception 
     * @throws PDOException 
     */
    public function findById(string $entity, int $id): Entity | bool
    {
        !is_a($entity, Entity::class, true) &&
            throw new Exception("Error $entity is not an " . Entity::class . " type", 1);


        $query = "SELECT * FROM {$entity::getTable()} WHERE id = :id";
        $stm = $this->db->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $entity);
        $stm->execute(['id' => $id]);
        return $stm->fetch();
    }



    /**
     * 
     * @param Entity|string $entity can be an intance of Entity or it's class name 
     * @param array $cond is an `key` => `value` array, where `key` is a `Entity` table field.
     * @return array Returns an array containing all of the result set rows 
     * @throws PDOException 
     */
    public function findAll(Entity|string $entity, array $cond = []): array
    {
        if (is_string($entity) && is_a($entity, Entity::class, true))
            $entity = new $entity();
        $cond = array_merge($cond, $entity->getModelFields());

        $where = "1 AND ";
        foreach ($cond as $key => $value) {
            if (is_string($value))
                $where .= "$key LIKE :$key AND ";
            else
                $where .= "$key = :$key AND ";
        }
        $where = rtrim($where, 'AND ');

        $query = "SELECT * FROM {$entity::getTable()} WHERE $where";
        $stm = $this->db->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $entity::class);
        $stm->execute($cond);
        return $stm->fetchAll();
    }

    public function remove(Entity $entity): bool|int
    {
        $query = "DELET FROM {$entity::getTable()} WHERE id = {$entity->id}";
        return $this->db->exec($query);
    }

    static function getManager(string $classname)
    {

        if (is_a($classname, Entity::class, true)) {
            $classname = explode('\\', $classname);

            $classname = end($classname);
            $classname = __NAMESPACE__ . '\\' . $classname . 'sManager';

            if (is_a($classname, EntityManager::class, true))
                return new $classname(static::$db);
        }
    }
}
