<?php

namespace App\Table;

use Core\Table\Table;
use PDOException;

class PostTable extends Table
{
    /**
     * Statement to get the last posts
     * @return array with the \compat function | !! use \extract to retrieve
     */
    public function last()
    {
        $statement = "SELECT p.id, p.title,p.leadIn, p.lastDate, c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id ORDER BY p.firstDate DESC";
        return \compact('statement');
    }

    /**
     * Statement to retrieves the last posts of the requested category
     * @param int $category_id
     * @return array with the \compat function | !! use \extract to retrieve
     */
    public function lastByCategory(int $category_id)
    {
        $statement = "SELECT p.id, p.title,p.leadIn, p.lastDate, c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id WHERE p.category_id = ? ORDER BY p.firstDate DESC";
        $attributes = [$category_id];
        return \compact('statement', 'attributes');
    }

    /**
     * Statement to get the last posts of the requested Author
     * @param int $user_id
     * @return array with the \compat function | !! use \extract to retrieve
     */
    public function lastByAuhtor(int $user_id)
    {
        $statement = "SELECT p.id, p.title,p.leadIn, p.lastDate, c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id WHERE p.user_id = ? ORDER BY p.firstDate DESC";
        $attributes = [$user_id];
        return \compact('statement', 'attributes');
    }

    /**
     * Retrieves an article by linking the associated category
     * @param int $id
     * @return object PDOStatement::fetchObject
     * @throws PDOException
     */
    public function findWithCategory(int $id)
    {
        return $this->query(
            "SELECT p.id, p.title,p.leadIn, p.content, p.lastDate, p.category_id,c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id WHERE p.id = ?",
            [$id],
            \true
        );
    }
}
