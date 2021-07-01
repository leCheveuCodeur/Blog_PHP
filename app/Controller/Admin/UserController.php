<?php

namespace App\Controller\Admin;


class UserController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
        $this->loadModel('Comment');
    }

    /**
     * Display of the connected User's dashboard
     * @return void
     */
    public function index(): void
    {
        $comments = $this->Comment->alert();
        $alert = $comments;

        $this->render('admin.user.index', \compact('comments', 'alert'));
    }
}
