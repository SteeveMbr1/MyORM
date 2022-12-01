<?php

namespace App\EntityManager;
use App\Entity\Entity;

class EntityManager {
    
    
    static protected function queryContructor(Entity $entity, ?array $where = null)
    {
        $query = "SELECT * FROM {$entity->getTable()}";
        $q = "";
        
        if ($entity->getId() < 0)
            return $query;
        $q .= "'id' = {$entity->getId()},";
        if ($where) {
            foreach ($where as $value) {
                $method = "get". ucfirst($value);
                if (method_exists($entity, $method))
                $q .= " '$value' LIKE '{$entity->$method()}',";
            }
        }
        $query .= " WHERE " . rtrim($q, ',') . ";";            
        return $query;
    }
    
    static public function find(Entity $entity, ?array $where = null) : Entity|null
    {
        
        echo self::queryContructor($entity, $where);
        
        die;
        return $entity;
    }
}