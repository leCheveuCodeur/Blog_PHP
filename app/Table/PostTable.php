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
        $statement = "SELECT p.id, p.title,p.leadIn, p.lastDate, c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id ORDER BY p.firstDate DESC";
        return \compact('statement');
    }

    /**
     * Récupère les derniers post de la catégorie demandé
     * @param int $category_id
     * @return \App\Entity\PostEntity
     * @throws PDOException
     */
    public function lastByCategory($category_id)
    {
        $statement = "SELECT p.id, p.title,p.leadIn, p.lastDate, c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id WHERE p.category_id = ? ORDER BY p.firstDate DESC";
        $attributes = [$category_id];
        return \compact('statement', 'attributes');
    }

    /**
     * Récupère les derniers post de l'Auteur demandé
     * @param int $user_id
     * @return \App\Entity\PostEntity
     * @throws PDOException
     */
    public function lastByAuhtor($user_id)
    {
        return $this->query(
            "SELECT p.id, p.title,p.leadIn, p.lastDate, c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id WHERE p.user_id = ? ORDER BY p.firstDate DESC",
            [$user_id]
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
            "SELECT p.id, p.title,p.leadIn, p.content, p.lastDate, c.title as category, u.username as author FROM post p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN user u ON p.user_id = u.id WHERE p.id = ?",
            [$id],
            \true
        );
    }
}
