<?php

namespace App\Controller;

class HomeController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display home page
     * @param null|string $message for validation
     * @return void
     */
    public function index()
    {
        $this->render('home.index');
    }


}
