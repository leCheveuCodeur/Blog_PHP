<?php

namespace App\Table;

use Core\Table\Table;

class CategoryTable extends Table
{
    public function onlyWithPosts()
    {
        return $this->query("SELECT DISTINCT c.id, c.title FROM category c RIGHT JOIN post p ON c.id = p.category_id");
    }

    public function list()
    {
        $statement = "SELECT * FROM category c";
        return \compact('statement');
    }
}
