<?php

namespace Core\Entity;

class Entity
{
    /**
     * Simplify the call of an existing method
     * @param string $key
     * @return method()
     */
    public function __get(string $key)
    {
        $method = "get" . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }
}
