<?php

namespace App\Entity;

class Entity
{
    public int $id;

    protected string $table;

    public function __construct()
    {
        $this->generate_table_name();
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
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * Set the value of table
     *
     * @param string $table
     *
     * @return self
     */
    public function setTable(string $table): self
    {
        $this->table = $table;

        return $this;
    }


    protected function generate_table_name()
    {
        $this->table = array_slice(explode('\\', $this::class), -1)[0];
    }

    /**
     * Get the value of fields
     *
     * @return array
     */
    public function getModelFields(): array
    {
        $class_name = $this::class;
        $fields     = [];

        foreach (get_mangled_object_vars($this) as $key => $v) {
            if (!str_contains($key, $class_name) && !str_contains($key, '*')) {
                $prop = 'get' . $this->to_camel_case($key);
                if (method_exists($this, $prop))
                    $fields[$key] = $this->$prop();
            }
        }
        return $fields;
    }

    private function to_camel_case(string $word)
    {
        return str_replace('_', '', ucwords($word, '_'));
    }
}
