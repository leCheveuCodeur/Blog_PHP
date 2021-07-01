<?php

namespace App\Controller\Admin;

use Core\Services\HTML\Paging;
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
     * @param null|string $message
     * @return void
     */
    public function index(?string $message = \null): void
    {
        \extract($this->Category->list());
        \extract(Paging::generate(6, 'admin.category.index', $this->Category, $statement));

        $alert = $this->Comment->alert();
        $this->render('admin.category.index', \compact('categorys', 'paging', 'message', 'alert'));
    }

    /**
     * Displaying the view to add a Category
     * @return void
     */
    public function add()
    {;
        $errors = \false;

        if (!empty($this->POST)) {
            try {
                $result = $this->Category->create([
                    "title" => $this->POST["title"]
                ]);
            } catch (\Exception $erros) {
                $errors = 'Catégorie déjà existante, veuillez changer le nom';
            }
            if ($errors === false) {
                return $this->index('Catégorie ajoutée');
            }
        }

        $alert = $this->Comment->alert();
        $form = new BootstrapForm($this->POST);
        $this->render('admin.category.edit', \compact('form', 'alert', 'errors'));
    }

    /**
     * Displaying the view to modify a Category
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {;

        $errors = \false;

        if (!empty($this->POST)) {
            try {
                $result = $this->Category->update($id, [
                    "title" => $this->POST["title"]
                ]);
            } catch (\Exception $erros) {
                $errors = 'Catégorie déjà existante, veuillez changer le nom';
            }
            if ($errors === false) {
                return $this->index('Catégorie modifiée');
            }
        }

        $category = $this->Category->find($id);
        $alert = $this->Comment->alert();
        $form = new BootstrapForm($category);
        $this->render('admin.category.edit', \compact('form', 'alert', 'category', 'errors'));
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
