<?php

namespace Core\Database;

use PDO;

class MysqlDatabase
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;


    public function __construct($db_name, $db_user = "root", $db_pass = "", $db_host = "localhost")
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPDO()
    {
        if ($this->pdo === \null) {
            $pdo = new PDO("mysql:dbname=blog;host=localhost", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement, $class_name = \null, $one = \false)
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

    public function prepare($statement, $attributes, $class_name = \null, $one = \false)
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

    public function lastInsertId()
    {
        return $this->getPDO()->lastInsertId();
    }
}
