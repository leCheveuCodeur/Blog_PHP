<?php

namespace App\Controller\Admin;

use App;
use Core\Auth\DBAuth;

class AppController extends \App\Controller\AppController
{
    public function __construct()
    {
        parent::__construct();
        $app = App::getInstance();
        $auth = new DBAuth($app->getDb()); //TODO a voir si c'est encore nécessaire puisque présent dans le parent App
        if (!$auth->logged()) {
            $this->forbidden();
        }
    }
}
