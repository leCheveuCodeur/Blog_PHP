<?php

namespace Core\Table;

use Core\Services\Database\MysqlDatabase;
use PDOException;

class Table
{
    public $table;
    protected MysqlDatabase $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        if (is_null($this->table)) {
            $parts = explode('\\', \get_class($this));
            $class_name = \end($parts);
            $this->table = \strtolower(\str_replace('Table', '', $class_name));
        }
    }

    /**
     * Simplifies SQL query preparation
     * @param string $statement
     * @param null|array $attributes
     * @param null|bool $one
     * @return mixed
     * @throws PDOException
     */
    public function query(string $statement, ?array $attributes = \null, ?bool $one = \false)
    {
        if ($attributes) {
            return $this->db->prepare($statement, $attributes, \str_replace('Table', 'Entity', \get_called_class()), $one);
        }
        return $this->db->query($statement, \str_replace('Table', 'Entity', \get_called_class()), $one);
    }

    /**
     * Fetches all the elements of a Table
     * @return mixed
     * @throws PDOException
     */
    public function all()
    {
        return $this->query("SELECT * FROM {$this->table}");
    }

    /**
     * Counts the number of rows in a table
     * @param null|string $statement
     * @param null|array $attributes
     * @return int
     * @throws PDOException
     */
    public function countRows(?string $statement = \null, ?array $attributes = \null): int
    {
        $statement = empty($statement) ? "SELECT COUNT(id) FROM {$this->table}" : \preg_replace('/SELECT.*FROM/im', "SELECT COUNT({$this->table[0]}.id) FROM", $statement);

        return $this->query($statement, $attributes);
    }

    /**
     * Fetch one element from a Table
     * @param int $id
     * @return mixed
     * @throws PDOException
     */
    public function find(int $id)
    {
        return $this->query(
            "SELECT * FROM {$this->table} WHERE id = ?",
            [$id],
            \true
        );
    }

    /**
     * Get the last X rows
     * @param string $statement
     * @param null|array $attributes
     * @param int $limit $limit number of post to return
     * @param int $page $page current page number
     * @return mixed
     * @throws PDOException
     */
    public function offset(string $statement, ?array $attributes = [], int $limit, int $page)
    {
        $offset = strval(($page - 1) * $limit);
        $attributes[] = \intval($offset);
        $attributes[] = \intval($limit);

        return $this->query(
            $statement . " LIMIT ?, ?",
            $attributes
        );
    }

    /**
     * Add an element to the Table
     * @param array $fields
     * @return mixed
     * @throws PDOException
     */
    public function create(array $fields)
    {
        $sql_parts = [];
        $attributes = [];

        foreach ($fields as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }

        $sql_part = implode(', ', $sql_parts);

        return $this->query(
            "INSERT INTO {$this->table} SET {$sql_part}",
            $attributes,
            \true
        );
    }

    /**
     * Edit an element to the Table
     * @param int $id
     * @param array $fields
     * @return mixed
     * @throws PDOException
     */
    public function update(int $id, array  $fields)
    {
        $sql_parts = [];
        $attributes = [];

        foreach ($fields as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;

        $sql_part = implode(', ', $sql_parts);

        return $this->query(
            "UPDATE {$this->table} SET {$sql_part} WHERE id = ?",
            $attributes,
            \true
        );
    }

    /**
     * Delet an element to the Table
     * @param int $id
     * @return mixed
     * @throws PDOException
     */
    public function delete(int $id)
    {
        return $this->query(
            "DELETE FROM {$this->table} WHERE id = ?",
            [$id],
            \true
        );
    }

    /**
     * Extracting properties from an Object
     * @param string $key
     * @param string $value
     * @return array
     * @throws PDOException
     */
    public function extract(string $key, string  $value)
    {
        $records = $this->all();
        $return = [];
        foreach ($records as $v) {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }
}
