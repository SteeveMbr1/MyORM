<?php

namespace App\Entity;

abstract class Entity
{
    public int $id;

    static protected string $table;

    public function __construct()
    {
        static::$table = $this::generate_table_name();
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
    public static function getTable(): string
    {
        if (!isset(static::$table))
            static::$table = static::generate_table_name();
        return static::$table;
    }

    /**
     * Set the value of table
     *
     * @param string $table
     */
    public static function setTable(string $table)
    {
        static::$table = $table;
    }


    protected static function generate_table_name(): string
    {
        return array_slice(explode('\\', static::class), -1)[0];
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
