<?php

namespace App\Table;

use Core\Entity\Entity;
use Core\Table\Table;
use PDOException;

class CategoryTable extends Table
{
    /**
     * Return only Categories with Posts
     * @return array
     * @throws PDOException
     */
    public function onlyWithPosts(): array
    {
        return $this->query("SELECT DISTINCT c.id, c.title FROM category c RIGHT JOIN post p ON c.id = p.category_id");
    }

    /**
     * Statement to retrieves Categories
     * @return array with the \compat function | !! use \extract to retrieve
     */
    public function list(): array
    {
        $statement = "SELECT * FROM category c";
        return \compact('statement');
    }
}
