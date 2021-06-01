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
            'SELECT DISTINCT c.id, c.content, c.lastDate date, u.username user FROM comment c LEFT JOIN user u ON u.id = c.user_id INNER JOIN post p ON  c.post_id = ? ORDER BY date DESC',
            [$id]
        );
    }

    public function modified($id)
    {
        return $this->query('');
    }
}
