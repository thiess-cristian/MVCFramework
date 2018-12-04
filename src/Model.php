<?php

namespace Framework;

use \PDO;
use App\Config;

abstract  class Model{

    protected  $table;

    public function newDbCon($resultAsArray=false){

        $dsn = Config::DB['driver'];
        $dsn .= ":host=".Config::DB['host'];
        $dsn .= ";dbname=".Config::DB['dbname'];
        $dsn .= ";port=".Config::DB['port'];
        $dsn .= ";charset=".Config::DB['charset'];

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        if ($resultAsArray) {
            $options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
        }

        try {
            return new PDO($dsn, Config['db']['user'], Config['db']['pass'], $options);
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
    public function get($id)
    {
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * this function will prepare data to be used in sql statement
     * 1. Will extract values from $data
     * 2. Will create the prepared sql string with columns from $data
     */
    protected function prepareDataForStmt(array $data): array
    {
        $columns = '';
        $values = [];

        for ($i = 0; $i < count($data); $i++) {

            $values[] = $data[$i];
            $columns .= "key($data) = ? ";
            //if we are not at the last element with the iteration
            if (count($data) < ($i + 1)) {
                $columns .= "AND ";
            }
        }
        return [$columns, $values];
    }

    /**
     *Find data with values
     */
    public Function find(array $data)
    {
        list($columns, $values) = $this->prepareDataForStmt($data);
        $db = $this->newDbCon();
        $stmt = $db->prepare("SELECT * from $this->table where $columns");
        return $stmt->execute([$values]);
    }

    /**
     *Insert new data in table
     */
    public function new(array $data)
    {
    }

    /**
     *Update data in table
     */
    public function update(array $data)
    {
    }

    /**
     *delete data from table
     */
    public function delete($id)
    {
    }
}
