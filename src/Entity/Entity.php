<?php

namespace MyORM\Entity;

use MyORM\Traits\ClassTrait;

abstract class Entity
{
    use ClassTrait;

    public int $id;

    protected array $hasOne;


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
     * Get the value of fields associetes to the table 
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

    public function __get($name)
    {

        if (array_key_exists($name, $this->hasOne)) {
            $prop = new $this->hasOne[$name]();
            $attri = "get$name";
            $prop->setId($this->$attri());
            return $prop;
        }
        return null;
    }
}
