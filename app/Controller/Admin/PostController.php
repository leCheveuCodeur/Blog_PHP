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
     * Display of all Posts of the connected User
     * @param null|string $message for validation
     * @return void
     */
    public function index(?int $page = \null, ?string $message = \null)
    {
        // Set the number of posts per page
        $limit = 2;

        \extract($this->Post->lastByAuhtor($_SESSION['auth']));
        \extract($this->paging($page, $statement, $limit, $attributes));

        $this->render('admin.post.index', \compact('page', 'posts', 'message', 'nbPages', 'previous', 'next'));
    }

    /**
     * Displaying the view to add a Post
     * @return void
     */
    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->Post->create([
                'user_id' => $_SESSION['auth'],
                'title' => $_POST['title'],
                'leadIn' => $_POST['leadIn'],
                'content' => $_POST['content'],
                'firstDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'category_id' => $_POST['category_id']
            ]);

            if ($result) {
                $message = "Article publié";
                return $this->index(null, $message);
            }
        }
        $this->loadModel('Category');
        $categories = $this->Category->extract('id', 'title');
        $form = new BootstrapForm($_POST);
        $this->render('admin.post.edit', \compact('categories', 'form'));
    }

    /**
     * Displaying the view to modify a Post
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        if (!empty($_POST)) {
            $result = $this->Post->update($id, [
                'title' => $_POST['title'],
                'leadIn' => $_POST['leadIn'],
                'content' => $_POST['content'],
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'category_id' => $_POST['category_id']
            ]);

            if ($result) {
                $message = "Article modifié";
                return $this->index(null, $message);
            }
        }

        $post = $this->Post->find($id);
        $this->loadModel('Category');
        $categories = $this->Category->extract('id', 'title');
        $form = new BootstrapForm($post);
        $this->render('admin.post.edit', \compact('categories', 'form'));
    }

    /**
     * Delete a Post
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->Post->delete($id);
        $message = "Article supprimé";
        return $this->index(null, $message);
    }
}
