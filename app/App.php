<?php

use Core\Config;
use Core\Services\Database\MysqlDatabase;


class App
{
    /**
     * Title display in <title>
     * @var string
     */
    public $title = "Mon super site";

    /**
     * Stock the DB instance
     * @var mixed
     */
    private $db_instance;

    /**
     * Stock the App instance
     * @var mixed
     */
    private static $_instance;

    /**
     * Create an App instance and stock it
     * @return mixed
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App;
        }
        return self::$_instance;
    }

    /**
     * Launch the session and the autoload
     * @return void
     */
    public static function load()
    {
        session_start();
        require_once '../vendor/autoload.php';
    }

    /**
     * Create an instance of the given Table
     * @param string $name table name ex: 'Post'
     * @return object ex: 'PostTable'
     */
    public function getTable(string $name)
    {
        $class_name = "\\App\\Table\\" . \ucfirst($name) . "Table";
        return new $class_name($this->getDb());
    }

    /**
     * Create an DB instance and stock it
     * @return object $db_instance MysqlDatabase
     */
    public function getDb()
    {
        $config = Config::getInstance(ROOT . "/config/config.php");
        if (empty($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
        }
        return $this->db_instance;
    }
}
