<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;

class CategoryController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Category');
    }

    public function index(?int $page = \null)
    {
        $limit = 2;

        \extract($this->Category->list());
        \extract($this->paging($page, $statement, $limit));

        $this->render('admin.category.index', \compact('page', 'categorys', 'nbPages', 'previous', 'next'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->Category->create([
                "title" => $_POST["title"]
            ]);

            return $this->index();
        }

        $form = new BootstrapForm($_POST);
        $this->render('admin.category.edit', \compact('form'));
    }

    public function edit($id)
    {
        if (!empty($_POST)) {
            $result = $this->Category->update($id, [
                "title" => $_POST["title"]
            ]);

            return  $this->index();
        }

        $category = $this->Category->find($id);
        $form = new BootstrapForm($category);
        $this->render('admin.category.edit', \compact('form'));
    }

    public function delete($id)
    {
        $this->Category->delete($id);
        return \header('Location: index.php?p=admin.category.index');
    }
}
