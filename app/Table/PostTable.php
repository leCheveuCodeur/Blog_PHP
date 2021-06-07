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
            "SELECT p.id, p.title,p.lead, p.lastDate, c.title as category FROM post p LEFT JOIN category c ON p.category_id = c.id ORDER BY p.firstDate DESC"
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
            "SELECT p.id, p.title, p.title,p.content, p.lastDate, c.title as category FROM post p LEFT JOIN category c ON p.category_id = c.id WHERE p.id = ?",
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
            "SELECT p.id, p.title, p.lead, c.title as category FROM post p LEFT JOIN category c ON p.category_id = c.id WHERE p.category_id = ? ORDER BY p.firstDate DESC",
            [$category_id]
        );
    }
}
