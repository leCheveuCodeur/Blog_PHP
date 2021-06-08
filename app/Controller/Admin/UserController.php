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

    public function index()
    {
        $comments=$this->Comment->pending();
        $this->render('admin.user.index', \compact('comments'));
    }
}
