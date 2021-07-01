<?php

namespace App\Entity;

use Core\Entity\Entity;

class CommentEntity extends Entity
{
    /**
     *  Return the URL of the Comment
     * @return string
     */
    public function getUrl(): string
    {
        return "index.php?p=comment.edit." . $this->id;
    }
}
