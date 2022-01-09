<?php

declare(strict_types=1);

class Query {

    private $sql = '';
    private $action = '';
    private $fields = [];
    private $table = '';

    public function __construct($table)
    {
        $this->table = $table;
    }

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
    /**
     * Example usage:
     * $sql = new Query('table');
     * $sql = $sql->get([fields])->append();
     * 
     * @param array $fields
     * @return this
     */
    public function get($fields)
    {
        $this->action = 'SELECT';
        $fieldList = $this->getFieldList($fields);
        $this->sql = "SELECT $fieldList FROM $this->table";
        return $this;
    }
    /**
     * Example usage:
     * $sql = new Query('table');
     * $sql = $sql->getAll()->append();
     * 
     * @return this
     */
    public function getAll()
    {
        $this->sql = "SELECT * FROM $this->table";
        return $this;
    }
    /**
     * Example usage:
     * $sql = new Query('table');
     * $sql = $sql->insert([fields])->append();
     * 
     * @param array $fields
     * @return this
     */
    public function insert($fields)
    {
        $this->action = 'INSERT';
        $fieldList = $this->getFieldList($fields)['fields'];
        $valueList = $this->getFieldList($fields)['values'];
        $this->sql = "INSERT INTO $this->table ($fieldList) VALUES ($valueList)";
        return $this;
    }
    /**
     * Example usage:
     * $sql = new Query('table');
     * $sql = $sql->update([fields])->append();
     * 
     * @param array $fields
     * @return this
     */
    public function update($fields)
    {
        $this->action = 'UPDATE';
        $fieldList = $this->getFieldList($fields);
        $this->sql = "UPDATE $this->table SET $fieldList";
        return $this;
    }
    /**
     * Example usage:
     * $sql = new Query('table');
     * $sql = $sql->delete()->append();
     * 
     * @param array $fields
     * @return this
     */
    public function delete()
    {
        $this->sql = "DELETE FROM $this->table";
        return $this;
    }
    /**
     * Returns sql-string
     *
     * @param string $sql
     * @return string
     */
    public function append($sql = '')
    {
        $sql = empty($sql) ? ';' : " $sql;";
        $this->sql .= $sql;
        return $this->sql;
    }
}