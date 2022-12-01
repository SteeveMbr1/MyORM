<?php

namespace App\Entity;

class Entity {

    /**
     * Undocumented function
     *
     * @param integer $id
     * @param string $table
     */
    public function __construct(protected int $id = -1, protected string $table = '')
    {
        $this->table = array_slice(explode('\\', $this::class), -1)[0];
    }

    

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the value of table
     */
    public function setTable($table): self
    {
        $this->table = $table;

        return $this;
    }
}