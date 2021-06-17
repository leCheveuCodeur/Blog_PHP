<?php

namespace App\Entity;

use Core\Entity\Entity;

class CategoryEntity extends Entity
{
    /**
     * Return the URL of the Category
     * @return string 
     */
    public function getUrl()
    {
        return "index.php?p=post.category." . $this->id;
    }


}
