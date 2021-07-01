<?php

namespace App\Table;

use Core\Table\Table;
use PDOException;

class CommentTable extends Table
{
    /**
     * Retrieve the latest Comments
     * @param int $id
     * @return array
     * @throws PDOException
     */
    public function findWithPost(int $id): array
    {
        return $this->query(
            'SELECT DISTINCT c.id, c.content, c.lastDate lastDate, u.username user FROM comment c LEFT JOIN user u ON u.id = c.user_id INNER JOIN post p ON  c.post_id = ? WHERE c.approved = 1 ORDER BY lastDate DESC',
            [$id]
        );
    }

    /**
     * Returns Comments pending validation
     * @return array
     * @throws PDOException
     */
    public function alert(): array
    {
        return $this->query(
            'SELECT c.id, c.content, c.lastDate lastDate, u.username user FROM comment c LEFT JOIN user u ON u.id = c.user_id WHERE c.approved = 0 ORDER BY lastDate DESC'
        );
    }

    /**
     * Statement to retrieves Comments pending validation
     * @return array  with the \compat function | !! use \extract to retrieve
     */
    public function pending(): array
    {
        $statement = ' SELECT c.id, c.content, c.lastDate lastDate, u.username user FROM comment c LEFT JOIN user u ON u.id = c.user_id WHERE c.approved = 0 ORDER BY lastDate ASC';
        return \compact('statement');
    }
}
