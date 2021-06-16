<?php

namespace Core\Table;

use Core\Database\MysqlDatabase;
use PDOException;

class Table
{
    protected $table;
    protected $db;

    public function __construct(MysqlDatabase $db)
    {

        $this->db = $db;
        if (is_null($this->table)) {
            $parts = explode('\\', \get_class($this));
            $class_name = \end($parts);
            $this->table = \strtolower(\str_replace('Table', '', $class_name));
        }
    }

    public function query($statement, $attributes = \null, $one = \false)
    {
        if ($attributes) {
            return $this->db->prepare($statement, $attributes, \str_replace('Table', 'Entity', \get_called_class()), $one);
        } else {
            return $this->db->query($statement,  \str_replace('Table', 'Entity', \get_called_class()), $one);
        }
    }

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
        if (!empty($statement)) {
            $statement = \preg_replace('/SELECT.*FROM/im', 'SELECT COUNT(p.id) FROM', $statement);
        }
        $statement = empty($statement) ? "SELECT COUNT(id) FROM {$this->table}" : $statement;

        return $this->query($statement, $attributes);
    }

    public function find($id)
    {
        return $this->query(
            "SELECT * FROM {$this->table} WHERE id = ?",
            [$id],
            \true
        );
    }

    /**
     * Get the last X rows
     * @param int $limit number of post to return
     * @param int $page current page number
     * @return \App\Entity\PostEntity
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


    public function create($fields)
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

    public function update($id, $fields)
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

    public function delete($id)
    {
        return $this->query(
            "DELETE FROM {$this->table} WHERE id = ?",
            [$id],
            \true
        );
    }

    public function extract($key, $value)
    {
        $records = $this->all();
        $return = [];
        foreach ($records as $v) {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }
}
