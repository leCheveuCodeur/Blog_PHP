<?php

namespace App\Controller\Admin;

use Core\Services\HTML\Paging;
use Core\Services\HTML\BootstrapForm;

class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
        $this->loadModel('Comment');
    }

    /**
     * Display of all Posts of the connected User
     * @param null|string $message for validation
     * @return void
     */
    public function index(?string $message = \null)
    {
        \extract($this->Post->lastByAuhtor($this->SESSION['auth']));
        \extract(Paging::generate(6, 'admin.post.index', $this->Post, $statement, $attributes));

        $alert = $this->Comment->alert();
        $this->render('admin.post.index', \compact('posts', 'paging', 'message', 'alert'));
    }

    /**
     * Displaying the view to add a Post
     * @return void
     */
    public function add()
    {
        if (!empty($this->POST)) {
            $result = $this->Post->create([
                'user_id' => $this->SESSION['auth'],
                'title' => $this->POST['title'],
                'leadIn' => $this->POST['leadIn'],
                'content' => $this->POST['content'],
                'firstDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'category_id' => $this->POST['category_id']
            ]);

            return $this->index('Article publié');
        }

        $categories = $this->Category->extract('id', 'title');
        $form = new BootstrapForm($this->POST);
        $alert = $this->Comment->alert();
        $this->render('admin.post.edit', \compact('alert', 'categories', 'form'));
    }

    /**
     * Displaying the view to modify a Post
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        if (!empty($this->POST)) {
            $result = $this->Post->update($id, [
                'title' => $this->POST['title'],
                'leadIn' => $this->POST['leadIn'],
                'content' => $this->POST['content'],
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'category_id' => $this->POST['category_id']
            ]);

            return $this->index('Article modifié');
        }

        $post = $this->Post->find($id);
        $categories = $this->Category->extract('id', 'title');
        $alert = $this->Comment->alert();
        $form = new BootstrapForm($post);
        $this->render('admin.post.edit', \compact('post', 'categories', 'form', 'alert'));
    }

    /**
     * Delete a Post
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->Post->delete($id);
        return $this->index('Article supprimé');
    }
}
