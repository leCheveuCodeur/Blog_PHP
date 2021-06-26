<?php

namespace Core\Services\Globals;

class Globals
{
    private $GET;
    private $POST;
    private $SERVER;
    private $SESSION;

    public function __construct()
    {
        $this->GET = \filter_input_array(\INPUT_GET) ?? \null;
        $this->POST = \filter_input_array(\INPUT_POST) ?? \null;
        $this->SERVER = \filter_input_array(\INPUT_SERVER) ?? \null;
        $this->SESSION = \filter_var_array($_SESSION, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    /**
     * Get $_GET
     * @param string $key
     * @return mixed
     */
    public function getGET(string $key = \null)
    {

        if (null !== $key) {
            return $this->GET[$key] ?? \null;
        }
        return $this->GET;
    }

    /**
     * Get $_POST
     * @param string $key
     * @return mixed
     */
    public function getPOST(string $key = \null)
    {

        if (null !== $key) {
            return $this->POST[$key] ?? \null;
        }
        return $this->POST;
    }

    /**
     * Get $_SERVER
     * @param string $key
     * @return mixed
     */
    public function getSERVER(string $key = \null)
    {

        if (null !== $key) {
            return $this->SERVER[$key] ?? \null;
        }
        return $this->SERVER;
    }

    /**
     * Get $_SESSION
     * @param string $key
     * @return mixed
     */
    public function getSESSION(string $key = \null)
    {

        if (null !== $key) {
            return $this->SESSION[$key] ?? \null;
        }
        return $this->SESSION;
    }

    // /**
    //  * Set $_SESSION
    //  * @param string $key
    //  * @param string $value
    //  * @return void
    //  */
    // public function setSESSION(string $key = \null, string $value)
    // {
    //     if (!empty($key)) {
    //         $this->SESSION[$key] = $value;
    //     }
    // }
}
