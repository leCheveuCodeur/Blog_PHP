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

        $nbPosts = $this->Post->count();
        $nbPages = \ceil($nbPosts / $limit);
        $page = !empty($page) && $page <= $nbPages ? $page : 1;
        $posts = $this->Post->paging($limit, $page);
        $previous = $page === 1 ? ' disabled' : \null;
        $next = $page >= $nbPages ? ' disabled' : \null;
        $categories = $this->Category->all();
        $this->render('post.index', \compact( 'page', 'posts', 'nbPosts', 'nbPages', 'previous', 'next', 'categories'));
    }

    public function category($postId)
    {
        $category =  $this->Category->find($postId);

        if ($category === false) {
            $this->notFound();
        }

        $posts = $this->Post->lastByCategory($postId);
        $categories = $this->Category->all();
        $this->render('post.category', \compact('posts', 'categories', 'category'));
    }

    public function show($postId)
    {
        $post = $this->Post->findWithCategory($postId);
        $comments = $this->Comment->findWithPost($postId);
        $form = new BootstrapForm($_POST);
        $this->render('post.show', \compact('post', 'comments', 'form'));
    }
}
