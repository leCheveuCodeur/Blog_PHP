<?php

namespace Core\Auth;

use Core\Database\MysqlDatabase;
use PDOException;

class DBAuth
{
    private $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION["auth"];
        }
        return \false;
    }

    /**
     * @param mixed $usernameOrEmail
     * @param mixed $password
     * @return mixed
     * @throws PDOException
     */
    public function login($usernameOrEmail, $password)
    {
        $user = $this->db->prepare("SELECT * FROM user WHERE username = ? or email = ?", [$usernameOrEmail,$usernameOrEmail], \null, \true);
        if ($user) {
            if (\password_verify($password, $user->password)) {
                $_SESSION["auth"] = $user->id;
                isset($user->admin) ? $_SESSION['admin'] = $user->admin : \false;
                return \true;
            }
        }
        return \false;
    }

    public function logged()
    {
        return isset($_SESSION["auth"]);
    }
}
