<?php

namespace App\Entity;

use Core\Entity\Entity;

class PostEntity extends Entity
{

    public function getUrl()
    {
        return 'index.php?p=post.show.'.$this->id;
    }

    public function getExtrait()
    {
        $html = "<p>" . \substr($this->lead, 0, 100) . "...</p>";
        $html .= "<p><a href= " . $this->getUrl() . ">Voir la suite</a></p>";
        return $html;
    }
}
