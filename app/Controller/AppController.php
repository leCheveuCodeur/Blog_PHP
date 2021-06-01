<?php

namespace App\Controller;

use App;
use Core\Auth\DBAuth;
use Core\Controller\Controller;

class AppController extends Controller
{
    protected $template = 'default';

    public function __construct()
    {
        $this->viewPath = \ROOT . '/app/Views/';
        // $app = App::getInstance();
        // $auth = new DBAuth($app->getDb());
        // if (!$auth->logged()) {
        //     $this->forbidden();
        // }
    }

    protected function loadModel($model_name)
    {
        $this->$model_name = App::getInstance()->getTable($model_name);
    }
}
