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

    public function index()
    {
        $items = $this->Category->all();
        $this->render('admin.category.index', \compact('items'));
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

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->Category->update($_GET["id"], [
                "title" => $_POST["title"]
            ]);

            return  $this->index();
        }

        $category = $this->Category->find($_GET["id"]);

        $form = new BootstrapForm($category);

        $this->render('admin.category.edit', \compact('form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->Category->delete($_POST["id"]);
            return $this->index();
        }
    }
}
