<?php

namespace Core;

class Config
{
    private $settings = [];
    private static $_instance;

    /**
     *Get the configuration variables
     * @param string $file ex: __DIR__. '/config/config.php'
     * @return mixed
     */
    static function getInstance(string $file)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    public function __construct($file)
    {
        $this->settings = require($file);
    }

    /**
     * Access to a configuration variable
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if (!isset($this->settings[$key])) {
            return \null;
        }
        return $this->settings[$key];
    }
}
