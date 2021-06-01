<?php

namespace App\Controller;

class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Category');
        $this->loadModel('Comment');
    }

    public function index()
    {
        $posts = $this->Post->last();
        $categories = $this->Category->all();
        $this->render('post.index', \compact('posts', 'categories'));
    }

    public function category()
    {
        $category =  $this->Category->find($_GET['id']);

        if ($category === false) {
            $this->notFound();
        }

        $posts = $this->Post->lastByCategory($_GET['id']);
        $categories = $this->Category->all();
        $this->render('post.category', \compact('posts', 'categories', 'category'));
    }

    public function show()
    {
        $post = $this->Post->findWithCategory($_GET['id']);
        $comments = $this->Comment->findWithPost($_GET['id']);
        $this->render('post.show', \compact('post', 'comments'));
    }
}
