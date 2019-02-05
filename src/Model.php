<?php

namespace Framework;

use \PDO;
use App\Config;

abstract class Model
{

    protected $table;

    public function newDbCon($resultAsArray = false): PDO
    {

        $dsn = Config::DB['driver'];
        $dsn .= ":host=" . Config::DB['host'];
        $dsn .= ";dbname=" . Config::DB['dbname'];
        $dsn .= ";port=" . Config::DB['port'];
        $dsn .= ";charset=" . Config::DB['charset'];

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        if ($resultAsArray) {
            $options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
        }

        try {
            return new PDO($dsn, Config::DB['user'], Config::DB['pass'], $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public Function getAll(): array
    {
        $db = $this->newDbCon();
        $stmt = $db->query("SELECT * from $this->table");

        return $stmt->fetchAll();
    }

    /**
     *Return data with specified id/index
     */
    public function get($id):array
    {
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * this function will prepare data to be used in sql statement
     * 1. Will extract values from $data
     * 2. Will create the prepared sql string with columns from $data
     */
    private function prepareStmt(array $data): array
    {
        $i = 1;
        $columns = '';
        $values = [];
        foreach ($data as $key => $value) {
            $values[] = $value;
            $columns .= $key .'=?';
            if($i < (count($data))) {
                $columns .= ", ";
            }
            $i++;
        }
        return [$columns, $values];
    }
    /**
     * this function will prepare data to be used in sql statement
     * 1. Will extract values from $data
     * 2. Will create the prepared sql string with columns from $data
     */
    protected function prepareDataSearchForStmt(array $data, bool $like): array
    {
        $columns = '';
        $values = [];
        $i = 1;
        $searchStr = "=";
        if ($like) {
            $searchStr = " LIKE ";
        }
        foreach($data as $key => $value) {
            $values[]= $value;
            $columns .= $key . $searchStr . "?";
            //if we are not at the last element with the iteration
            if($i < (count($data))) {
                $columns .= " AND ";
            }
            $i++;
        }
        return [$columns, $values];
    }


    /**
     *Find data with values
     */
    public Function find(array $data,bool $like = false): array
    {
        list($columns, $values) = $this->prepareDataSearchForStmt($data, $like);
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where $columns");

        $stmt->execute($values);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *Insert new data in table
     */
    public function new(array $data): int
    {
        list($columns, $values) = $this->prepareStmt($data);
        $db = $this->newDbCon();
        $stmt = $db->prepare('INSERT INTO ' . $this->table . ' SET ' . $columns);
        $stmt->execute($values);
        return $db->lastInsertId();
    }

    /**
     * Update data in table
     */
    public function update(array $where, array $data): bool
    {
        list($columns, $values) = $this->prepareStmt($data);
        //add the value of $where array to the list of $values that will be used in the prepared statement
        //reset($where) it's a trick to extract the value of an associative array with a single element
        $values[] = reset($where);
        $db = $this->newDbCon();
        $stmt = $db->prepare('UPDATE ' . $this->table . ' SET ' . $columns . ' WHERE ' . key($where) . '=?');
        return $stmt->execute($values);
    }

    /**
     *delete data from table
     */
    public function delete($id): bool
    {
        $db = $this->newDbCon();
        $stmt = $db->prepare('delete from ' . $this->table . ' where id=?');
        return $stmt->execute([$id]);
    }
}
