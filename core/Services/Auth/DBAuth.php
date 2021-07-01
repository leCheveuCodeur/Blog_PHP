<?php

namespace Core\Services\Auth;

use PDOException;
use Core\Services\Globals\Globals;
use Core\Services\Database\MysqlDatabase;

class DBAuth
{
    private $db;
    protected $globals;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        $this->globals = new Globals;
    }

    /**
     * Returns the Id of the connected User
     * @return mixed $id|false
     */
    public function getUserId()
    {
        if ($this->logged()) {
            return $this->SESSION["auth"];
        }
        return \false;
    }

    /**
     * Check the login
     * @param string $usernameOrEmail
     * @param string $password
     * @return bool
     * @throws PDOException
     */
    public function login(string $usernameOrEmail, string $password): bool
    {
        $user = $this->db->prepare("SELECT * FROM user WHERE username = ? or email = ?", [$usernameOrEmail, $usernameOrEmail], \null, \true);
        if ($user) {
            if (\password_verify($password, $user->password)) {
                $_SESSION["auth"] = $user->id;
                isset($user->admin) ? $_SESSION['admin'] = $user->admin : \false;
                return \true;
            }
        }
        return \false;
    }

    /**
     * Checks if the Visitor is logged
     * @return bool
     */
    public function logged(): bool
    {
        return !empty($this->globals->getSESSION("auth"));
    }
}
