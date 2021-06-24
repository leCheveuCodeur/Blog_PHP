<?php

namespace App\Controller\Admin;

use Core\Services\HTML\BootstrapForm;

class CategoryController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Category');
        $this->loadModel('Comment');
    }

    /**
     *  Displaying Categories
     * @param null|int $page
     * @param null|string $message
     * @return void
     */
    public function index(?int $page = \null, ?string $message = \null)
    {
        // Set the number of categories per page
        $limit = 2;

        \extract($this->Category->list());
        \extract($this->paging($page, $statement, $limit));

        $alert=$this->Comment->alert();
        $this->render('admin.category.index', \compact('page', 'categorys', 'message', 'nbPages', 'previous', 'next','alert'));
    }

    /**
     * Displaying the view to add a Category
     * @return void
     */
    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->Category->create([
                "title" => $_POST["title"]
            ]);

            if ($result) {
                $message = "Catégorie ajoutée";
                return $this->index(null, $message);
            }
        }

        $alert=$this->Comment->alert();
        $form = new BootstrapForm($_POST);
        $this->render('admin.category.edit', \compact('form','alert'));
    }

    /**
     * Displaying the view to modify a Category
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        if (!empty($_POST)) {
            $result = $this->Category->update($id, [
                "title" => $_POST["title"]
            ]);

            if ($result) {
                $message = "Catégorie modifiée";
                return $this->index(null, $message);
            }
        }

        $category = $this->Category->find($id);
        $alert=$this->Comment->alert();
        $form = new BootstrapForm($category);
        $this->render('admin.category.edit', \compact('form','alert','category'));
    }

    /**
     * Delete a Category
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        $this->Category->delete($id);
        $message = "Catégorie supprimée";
        return $this->index(null, $message);
    }
}
