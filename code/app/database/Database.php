<?php

declare(strict_types=1);

Trait Database {
    
    private $pdo;
    private $sql;
    private $statement;

    private function getFieldList($fieldArray, $separator = ', ')
    {
        $fields = [];
        foreach ($fieldArray as $field) {
            array_push($fields, "$field = :$field");
        }
        return implode($separator, $fields);
    }

    private function getWhereList($fieldArray, $operator, $separator)
    {
        $fields = [];
        foreach ($fieldArray as $field => $value) {
            array_push($fields, "$field $operator $value");
        }
        return implode($separator, $fields);
    }

    public function sqlite($databaseName = 'sqlite')
    {
        $databasePath = sprintf('sqlite:%s/database_%s.db', __DIR__, $databaseName);
        $this->pdo = new PDO($databasePath);
        return $this;
    }

    public function get($fields)
    {
        $fieldList = $this->getFieldList($fields);
        $this->sql = "SELECT $fieldList FROM ";
        return $this;
    }

    public function getAll()
    {
        $this->sql = 'SELECT * FROM ';
        return $this;
    }

    public function update($tableName)
    {
        $this->sql = "UPDATE $tableName SET ";
        return $this;
    }

    public function table($table)
    {
        $this->sql .= "$table ";
        return $this;
    }

    public function fields($fields)
    {
        $fieldList = $this->getFieldList($fields);
        $this->sql .= "$fieldList ";
        return $this;
    }

    public function where($fields, $operator = '=', $separator = ' AND ')
    {
        $fieldList = $this->getWhereList($fields, $operator, $separator);
        $this->sql .= "WHERE $fieldList";
        return $this;
    }

    public function prepare()
    {
        $this->sql = trim($this->sql) . ';';
        $this->statement = $this->pdo->prepare($this->sql);
        if (!$this->statement) die(var_dump($this->pdo->errorInfo()));
        return $this;
    }

    public function bind($fieldName, $fieldValue, $pdoBindOption)
    {
        $this->statement->bindParam(":$fieldName", $fieldValue, $pdoBindOption);
        return $this;
    }

    public function execute()
    {
        $this->statement->execute();
        return $this;
    }

    public function fetch($pdoFetchOption = PDO::FETCH_OBJ)
    {
        return $this->statement->fetch($pdoFetchOption);
    }

    public function fetchAll($pdoFetchOption = PDO::FETCH_OBJ)
    {
        return $this->statement->fetchAll($pdoFetchOption);
    }

    public function debug()
    {
        echo '<pre>', var_dump($this->statement), '</pre>';
        exit;
    }

    public function debugSql()
    {
        $this->sql = trim($this->sql) . ';';
        echo '<pre>', var_dump($this->sql), '</pre>';
        exit;
    }
}