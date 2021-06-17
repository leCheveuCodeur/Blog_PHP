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

    /**
     * Displaying Posts in DESC order
     * @param null|int $page
     * @return void
     */
    public function index(?int $page = \null)
    {
        // Set the number of posts per page
        $limit = 4;

        \extract($this->Post->last());
        \extract($this->paging($page, $statement, $limit));

        $categories = $this->Category->onlyWithPosts();
        $this->render('post.index', \compact('page', 'posts', 'nbPages', 'previous', 'next', 'categories'));
    }

    /**
     * Displaying the Posts of a Category
     * @param int $category_id
     * @param null|int $page
     * @return void
     */
    public function category(int $category_id, ?int $page = \null)
    {
        // Set the number of posts per page
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

    /**
     * Display of a specific Post
     * @param int $postId 
     * @return void 
     */
    public function show(int $postId)
    {
        $post = $this->Post->findWithCategory($postId);
        $comments = $this->Comment->findWithPost($postId);
        $form = new BootstrapForm($_POST);
        $this->render('post.show', \compact('post', 'comments', 'form'));
    }
}
