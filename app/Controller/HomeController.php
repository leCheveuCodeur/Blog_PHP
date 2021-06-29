<?php

namespace App\Controller;

class HomeController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    /**
     * Display home page
     * @return void
     */
    public function index()
    {
        $alert = $this->Comment->alert();
        $this->render('home.index', \compact('alert'));
    }
}
