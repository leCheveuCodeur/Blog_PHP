<?php

namespace App\Table;

use Core\Table\Table;
use PDOException;

class CommentTable extends Table
{
    /**
     * Récupère les derniers commentaires
     * @return \App\Entity\CommentEntity
     * @throws PDOException
     */
    public function findWithPost($id)
    {
        return $this->query(
            'SELECT DISTINCT c.id, c.content, c.lastDate lastDate, u.username user FROM comment c LEFT JOIN user u ON u.id = c.user_id INNER JOIN post p ON  c.post_id = ? WHERE c.approved = 1 ORDER BY lastDate DESC',
            [$id]
        );
    }

    public function pending()
    {
        $statement = ' SELECT c.id, c.content, c.lastDate lastDate, u.username user FROM comment c LEFT JOIN user u ON u.id = c.user_id WHERE c.approved = 0 ORDER BY lastDate ASC';
        return \compact('statement');
    }
}
