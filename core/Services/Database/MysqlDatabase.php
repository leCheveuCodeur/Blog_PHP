<?php

namespace Core\Services\Database;

use PDO;
use PDOException;

class MysqlDatabase
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;


    /**
     * Construct - set the environment variables
     * @param string $db_name
     * @param string $db_user
     * @param string $db_pass
     * @param string $db_host
     * @return void
     */
    public function __construct(string $db_name, string $db_user = "root", string $db_pass = "", string $db_host = "localhost")
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    /**
     * Get PDO - connect to the server
     * @return PDO
     */
    private function getPDO(): PDO
    {
        if ($this->pdo === \null) {
            $pdo = new PDO("mysql:dbname={$this->db_name};host={$this->db_host}", $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * Query - auto manages the fetch mode & type
     * @param string $statement
     * @param null|string $class_name
     * @param null|bool $one
     * @return mixed
     */
    public function query(string $statement, ?string $class_name = \null, ?bool $one = \false)
    {
        $req = $this->getPDO()->query($statement);

        if (
            \strpos($statement, "UPDATE") === 0 ||
            \strpos($statement, "INSERT") === 0 ||
            \strpos($statement, "DELETE") === 0
        ) {
            return $req;
        }

        if (\strpos($statement, 'COUNT')) {
            return $req->fetchColumn();
        }

        $class_name === \null ? $req->setFetchMode(PDO::FETCH_OBJ) : $req->setFetchMode(PDO::FETCH_CLASS, $class_name);

        $datas = ($one === \true) ? $req->fetch() : $req->fetchAll();

        return $datas;
    }

    /**
     * Prepare - auto manages the fetch mode & type
     * @param string $statement
     * @param array $attributes
     * @param null|string $class_name
     * @param null|bool $one
     * @return mixed
     * @throws PDOException
     */
    public function prepare(string $statement, array $attributes, ?string $class_name = \null, ?bool $one = \false)
    {
        $req = $this->getPDO()->prepare($statement);
        foreach ($attributes as $key => $value) {
            if (is_int($value)) {
                $req->bindValue($key + 1, $value, PDO::PARAM_INT);
            } else {
                $req->bindValue($key + 1, $value, PDO::PARAM_STR);
            }
        }
        $res = $req->execute();


        if (
            \strpos($statement, "UPDATE") === 0 ||
            \strpos($statement, "INSERT") === 0 ||
            \strpos($statement, "DELETE") === 0
        ) {
            return $res;
        }

        if (\strpos($statement, 'COUNT')) {
            return $req->fetchColumn();
        }

        if ($class_name === \null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }

        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }
}
