<?php

namespace App\Controller;

use App;
use Core\Controller\Controller;

class AppController extends Controller
{
    protected $template = 'default';
    protected $table;

    public function __construct()
    {
        $this->viewPath = \ROOT . '/app/Views/';
        $this->table = $this->tableName();
    }

    protected function loadModel($model_name)
    {
        $this->$model_name = App::getInstance()->getTable($model_name);
    }
}
