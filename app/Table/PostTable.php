<?php

namespace App\Table;

use Core\Table\Table;
use PDOException;

class PostTable extends Table
{
    /**
     * Récupère les derniers post
     * @return \App\Entity\PostEntity
     * @throws PDOException
     */
    public function last()
    {
        return $this->query(
            "SELECT post.id, post.title, post.content, post.date, category.title as category FROM post LEFT JOIN category ON category_id = category.id ORDER BY post.date DESC"
        );
    }

    /**
     * Récupère un acticle en liant la catégorie associée
     * @param int $id
     * @return \App\Entity\PostEntity
     * @throws PDOException
     */
    public function findWithCategory($id)
    {
        return $this->query(
            "SELECT post.id, post.title, post.content, post.date, category.title as category FROM post LEFT JOIN category ON category_id = category.id WHERE post.id = ?",
            [$id],
            \true
        );
    }

    /**
     * Récupère les derniers post de la catégorie demandé
     * @param int $category_id
     * @return \App\Entity\PostEntity
     * @throws PDOException
     */
    public function lastByCategory($category_id)
    {
        return $this->query(
            "SELECT post.id, post.title, post.content, category.title as category FROM post LEFT JOIN category ON category_id = category.id WHERE post.category_id = ? ORDER BY post.date DESC",
            [$category_id]
        );
    }
}
