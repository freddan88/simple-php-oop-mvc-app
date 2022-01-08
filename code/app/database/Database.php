<?php

declare(strict_types=1);

Trait Database {
    
    private $sql = '';
    private $action = '';
    private $fields = [];
    private $table = '';
    private $statement;
    private $pdo;

    private function getSelectFieldList($fields)
    {
        foreach ($fields as $field) {
            array_push($this->fields, $field);
        }
        return implode(', ', $this->fields);
    }

    private function getInsertFieldList($fields)
    {
        $values = [];
        foreach ($fields as $field) {
            array_push($this->fields, $field);
            array_push($values, ":$field");
        }
        $query['values'] = implode(', ', $values);
        $query['fields'] = implode(', ', $this->fields);
        return $query;
    }

    private function getUpdateFieldList($fields)
    {
        foreach ($fields as $field) {
            array_push($this->fields, "$field = :$field");
        }
        return implode(', ', $this->fields);
    }

    private function getFieldList($fields)
    {
        switch ($this->action) {
            case 'SELECT':
                return $this->getSelectFieldList($fields);
            case 'INSERT':
                return $this->getInsertFieldList($fields);
            case 'UPDATE':
                return $this->getUpdateFieldList($fields);
        }
    }

    public function table($tableName)
    {
        $this->table = $tableName;
        $this->fields = [];
        return $this;
    }

    public function get($fields)
    {
        $this->action = 'SELECT';
        $fieldList = $this->getFieldList($fields);
        $this->sql = "SELECT $fieldList FROM $this->table";
        return $this;
    }

    public function getAll()
    {
        $this->sql = "SELECT * FROM $this->table";
        return $this;
    }

    public function insert($fields)
    {
        $this->action = 'INSERT';
        $fieldList = $this->getFieldList($fields)['fields'];
        $valueList = $this->getFieldList($fields)['values'];
        $this->sql = "INSERT INTO $this->table ($fieldList) VALUES ($valueList)";
        return $this;
    }

    public function update($fields)
    {
        $this->action = 'UPDATE';
        $fieldList = $this->getFieldList($fields);
        $this->sql = "UPDATE $this->table SET $fieldList";
        return $this;
    }

    public function delete()
    {
        $this->sql = "DELETE FROM $this->table";
        return $this;
    }

    public function append($sql = '')
    {
        $sql = empty($sql) ? ';' : " $sql;";
        $this->sql .= $sql;
        return $this->sql;
    }

    public function sqlite($databaseName = 'sqlite')
    {
        $databasePath = sprintf('sqlite:%s/database_%s.db', __DIR__, $databaseName);
        $this->pdo = new PDO($databasePath);
        return $this;
    }

    public function prepare($sql)
    {
        $this->statement = $this->pdo->prepare($sql);
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
}