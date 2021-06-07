<?php

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;

class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
    }

    /**
     *
     * @param null|string $message
     * @return void
     */
    public function index(?string $message = \null)
    {
        $posts = $this->Post->all();
        $this->render('admin.post.index', \compact('posts', 'message'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->Post->create([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'firstDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'category_id' => $_POST['category_id']
            ]);

            if ($result) {
                $message = "Article publié";
                return $this->index($message);
            }
        }
        $this->loadModel('Category');
        $categories = $this->Category->extract('id', 'title');
        $form = new BootstrapForm($_POST);
        $this->render('admin.post.edit', \compact('categories', 'form'));
    }

    public function edit($id)
    {
        if (!empty($_POST)) {
            $result = $this->Post->update($id, [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'category_id' => $_POST['category_id']
            ]);

            if ($result) {
                $message = "Article modifié";
                return $this->index($message);
            }
        }

        $post = $this->Post->find($id);
        $this->loadModel('Category');
        $categories = $this->Category->extract('id', 'title');
        $form = new BootstrapForm($post);
        $this->render('admin.post.edit', \compact('categories', 'form'));
    }

    public function delete($id)
    {
        $this->Post->delete($id);
        $message = "Article supprimé";
        return $this->index($message);
    }
}
