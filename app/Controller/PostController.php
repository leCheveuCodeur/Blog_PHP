<?php

namespace App\Controller;

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
     * Displaying Posts in DESC order
     * @param null|int $page
     * @return void
     */
    public function index(): void
    {
        \extract($this->Post->last());
        \extract(Paging::generate(6, 'post.index', $this->Post, $statement));

        $categories = $this->Category->onlyWithPosts();
        $comments = $this->Comment;
        $alert = $this->Comment->alert();
        $this->render('post.index', \compact('paging', 'posts', 'categories', 'comments', 'alert'));
    }

    /**
     * Displaying the Posts of a Category
     * @param int $category_id
     * @return void
     */
    public function category(int $category_id)
    {
        $category =  $this->Category->find($category_id);
        if ($category === false) {
            $this->notFound();
        }

        \extract($this->Post->lastByCategory($category_id));
        \extract(Paging::generate(6, 'post.category.' . $category_id, $this->Post, $statement, $attributes));

        $categories = $this->Category->onlyWithPosts();
        $comments = $this->Comment;
        $alert = $this->Comment->alert();
        $this->render('post.category', \compact('category_id', 'posts', 'paging', 'categories', 'category', 'comments', 'alert'));
    }

    /**
     * Display of a specific Post
     * @param int $postId
     * @param null|string $message
     * @return void
     */
    public function show(int $postId, ?string $message = \null)
    {
        if (!empty($this->POST) && !empty($this->SESSION)) {
            $comment = $this->Comment->create([
                'content' => $this->POST['content'],
                'firstDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'user_id' => $this->SESSION['auth'],
                'post_id' => $postId
            ]);

            $message='Commentaire soumis !';
        };

        $post = $this->Post->findWithCategory($postId);
        $comments = $this->Comment->findWithPost($postId);
        $alert = $this->Comment->alert();
        $form = new BootstrapForm();
        $this->render('post.show', \compact('post', 'comments', 'alert', 'form', 'message'));
    }
}
