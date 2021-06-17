<?php

namespace App\Entity;

use Core\Entity\Entity;

class PostEntity extends Entity
{
    /**
     * Return the URL of the Post
     * @return string
     */
    public function getUrl()
    {
        return 'index.php?p=post.show.' . $this->id;
    }

    /**
     * Return an extrait of 100 characters
     * @return string 
     */
    public function getExtrait()
    {
        $html = "<p>" . \substr(\nl2br(\htmlspecialchars($this->leadIn)), 0, 100) . "...</p>";
        $html .= "<p><a href= " . $this->getUrl() . ">Voir la suite</a></p>";
        return $html;
    }
}
