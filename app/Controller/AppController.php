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
        parent::__construct();
        $this->viewPath = \ROOT . '/app/Views/';
        $this->table = $this->tableName();
    }

    /**
     * Return the searched Table
     * @param string $model_name
     * @return mixed
     */
    protected function loadModel(string $model_name)
    {
        if (empty($this->$model_name)) {
            $this->$model_name = App::getInstance()->getTable($model_name);
        }
        return $this->$model_name;
    }
}
