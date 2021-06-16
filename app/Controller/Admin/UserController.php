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
        $comments=$this->Comment->alert();
        $this->render('admin.user.index', \compact('comments'));
    }
}
