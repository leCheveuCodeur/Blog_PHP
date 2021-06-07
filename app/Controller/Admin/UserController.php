<?php

namespace App\Controller\Admin;


class UserController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }

    public function index()
    {
        $this->render('admin.user.index');
    }
}
