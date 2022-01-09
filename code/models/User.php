<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/Database.php");
require_once(__DIR__ . "../../app/security/Sanitize.php");

class User extends Sanitize {
    use Database;

    private $databaseTableFields = [];
    private $databaseTable = '';
    private $postData = [];
    private $sql = '';
    private $pdoStatement;

    public function __construct($postData, $databaseTable, $databaseTableFields)
    {
        $this->postData = $postData;
        $this->databaseTable = $databaseTable;
        $this->databaseTableFields = $databaseTableFields;

        // $updateSql = $this->table($table)->update(['name'])->append('WHERE id = 1');
        // $this->sqlite()->prepare($updateSql)
        // ->bind($fields[0],'Freddan', PDO::PARAM_STR)
        // ->execute()->cleanup();

        // $selectAllSql = $this->table($table)->getAll()->append();
        // $selectAllData = $this->sqlite()->prepare($selectAllSql)->execute()->fetchAll();

        // $selectSql = $this->table($table)->get(['name'])->append('WHERE id = 2');
        // $selectData = $this->sqlite()->prepare($selectSql)->execute()->fetch();

        // $deleteSql = $this->table($table)->delete()->append('WHERE id = 2');
        // $this->sqlite()->prepare($deleteSql)->execute()->cleanup();
    }

    public function create()
    {
        $this->sql = $this->table($this->databaseTable)->insert($this->databaseTableFields)->append();
        return $this;
    }

    public function update($table, $fields, $sql)
    {
        $sql = $this->table($table)->insert($fields)->append();
        $this->pdoStatement = $this->sqlite()->prepare($sql);
        return $this;
    }

    public function add($field, $value, $pdoParam = PDO::PARAM_STR)
    {
        $this->pdoStatement->bind($field, $value, $pdoParam);
    }

    public function run()
    {
        $this->pdoStatement->execute()->cleanup();
    }

    public function save()
    {
        $name = 'Fredrik';
        $email = $this->sanitizeString($this->postData['email']);
        $password = $this->sanitizeString($this->postData['password']);
        $admin = 0;

        $this->sqlite()->prepare($this->sql)
        ->bind($this->fields[0], $name, PDO::PARAM_STR)
        ->bind($this->fields[1], $email, PDO::PARAM_STR)
        ->bind($this->fields[2], $password, PDO::PARAM_STR)
        ->bind($this->fields[3], $admin, PDO::PARAM_INT)
        ->execute()->cleanup();
    }
}