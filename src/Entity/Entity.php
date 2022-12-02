<?php

namespace App\Entity;

class Entity
{

    protected string $table;
    protected array $fields = [];

    public function __construct(protected int $id = 0)
    {
        $this->generateTableName();
    }

    protected function generateTableName()
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

    /**
     * Get the value of fields
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Set the value of fields
     *
     * @param array $fields
     *
     * @return self
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    private function to_camel_case(string $word)
    {
        return str_replace('_', '', ucwords($word, '_'));
    }

    public function __get($name)
    {
        $prop = 'get' . $this->to_camel_case($name);
        return $this->$prop();
    }
}
