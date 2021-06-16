<?php

namespace App\Controller;

use Core\HTML\BootstrapForm;

class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
        $this->loadModel('Comment');
    }

    public function index(?int $page = \null)
    {
        $limit = 4;

        \extract($this->Post->last());
        \extract($this->paging($page, $statement, $limit));

        $categories = $this->Category->onlyWithPosts();
        $this->render('post.index', \compact('page', 'posts', 'nbPages', 'previous', 'next', 'categories'));
    }

    public function category(int $category_id, ?int $page = \null)
    {
        $limit = 2;

        $category =  $this->Category->find($category_id);
        if ($category === false) {
            $this->notFound();
        }

        \extract($this->Post->lastByCategory($category_id));
        \extract($this->paging($page, $statement, $limit, $attributes));

        $categories = $this->Category->onlyWithPosts();
        $this->render('post.category', \compact('page', 'posts', 'nbPages', 'previous', 'next', 'categories', 'category'));
    }

    public function show($postId)
    {
        $post = $this->Post->findWithCategory($postId);
        $comments = $this->Comment->findWithPost($postId);
        $form = new BootstrapForm($_POST);
        $this->render('post.show', \compact('post', 'comments', 'form'));
    }
}
