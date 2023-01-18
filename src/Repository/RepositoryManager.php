<?php

namespace MyORM\Repository;

use MyORM\Entity\Entity;
use MyORM\Traits\ClassTrait;
use PDO;
use PDOException;

class RepositoryManager
{
    use ClassTrait;

    protected ?string $entity;
    protected ?string $table;

    public function __construct(
        protected PDO $db,
        ?string $entity = null,
        ?string $table = null,
    ) {
        $this->table = $table ?? $this->table ?? $this->generateTable();
        $this->entity = $entity ?? $this->entity ?? $this->generateEntity();
    }


    /**
     * Get the value of entity
     *
     * @return ?string
     */
    public function getEntity(): ?string
    {
        return $this->entity;
    }

    /**
     * Set the value of entity
     *
     * @param ?string $entity
     *
     * @return self
     */
    public function setEntity(?string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get the value of table
     *
     * @return ?string
     */
    public function getTable(): ?string
    {
        return $this->table;
    }

    /**
     * Set the value of table
     *
     * @param ?string $table
     *
     * @return self
     */
    public function setTable(?string $table): self
    {
        $this->table = $table;

        return $this;
    }

    public function generateEntity(): string
    {
        if (isset($this->entity))
            $entity = $this->entity;
        $entity = str_replace('Manager', '', static::class);
        $entity = rtrim($entity, 's');
        $entity = str_replace('Repository\\', 'Entity\\', $entity);
        return $entity;
    }

    public function generateTable(): string
    {
        if (isset($this->table))
            $table = $this->table;
        $table = str_replace('Manager', '', static::class());
        $table = rtrim($table, 's');
        return $table;
    }

    /**
     * Find one entry in the database table with this $id
     * @param int $id 
     * @return mixed 
     * @throws PDOException 
     */
    public function findById(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stm = $this->db->prepare($query);
        $stm->execute(['id' => $id]);
        return $stm->fetchObject($this->entity);
    }

    /**
     * Insert a new row in the table
     * @param Entity $entity 
     * @return Entity 
     * @throws PDOException 
     */
    public function create(Entity $entity): Entity
    {
        // TODO : 
        $modelfields = $entity->getModelFields();
        $fields = join(', ', array_keys($modelfields));
        $values = join(', :', array_keys($modelfields));
        $query = "INSERT INTO {$this->table} ($fields) VALUES (:$values)";


        $stmt = $this->db->prepare($query);
        $stmt->execute($modelfields);
        $entity->id = $this->db->lastInsertId();
        return $entity;
    }

    /**
     * Update a row in the table
     * @param Entity $entity 
     * @return Entity 
     * @throws PDOException 
     */
    public function update(Entity $entity): Entity
    {
        $modelfields = $entity->getModelFields();
        $set = "";
        foreach ($modelfields as $key => $value) {
            if ($key != 'id')
                $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $query = "UPDATE {$this->table} SET $set WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute($modelfields);

        return $entity;
    }

    /**
     * 
     * @param Entity|string $entity can be an intance of Entity or it's class name 
     * @param array $cond is an `key` => `value` array, where `key` is a `Entity` table field.
     * @return array Returns an array containing all of the result set rows 
     * @throws PDOException 
     */
    public function findAll(array $cond = []): array
    {
        if (is_string($this->entity) && is_a($this->entity, Entity::class, true))
            $entity = new $this->entity;
        $cond = array_merge($cond, $entity->getModelFields());

        $where = "1 AND ";
        foreach ($cond as $key => $value) {
            if (is_string($value))
                $where .= "$key LIKE :$key AND ";
            else
                $where .= "$key = :$key AND ";
        }
        $where = rtrim($where, 'AND ');

        $query = "SELECT * FROM {$this->table} WHERE $where";
        $stm = $this->db->prepare($query);
        $stm->setFetchMode(PDO::FETCH_CLASS, $this->entity);
        $stm->execute($cond);
        return $stm->fetchAll();
    }

    public function remove(Entity $entity): bool|int
    {
        $query = "DELET FROM {$this->table} WHERE id = {$entity->id}";
        return $this->db->exec($query);
    }

    //** Not tested yet **//
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

    public function _toString()
    {
        return print_r($this, true);
    }
}
