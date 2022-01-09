<?php

declare(strict_types=1);

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

Trait Database {
    
    private $statement;
    private $pdo;

    public function sqlite($databaseName = '', $pdoOptions = [])
    {
        $databaseName = empty($databaseName) ? 'sqlite' : $databaseName;
        $databasePath = __DIR__ . "../../database/database_$databaseName.db";
        $dsn = "sqlite:$databasePath";
        try {
            $this->pdo = new PDO($dsn, null, null, $pdoOptions);
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
        return $this;
    }

    public function prepare($sql)
    {
        $statement = $this->pdo->prepare($sql);
        if (!$this->statement) die(var_dump($this->pdo->errorInfo()));
        return $this->pdo->errorInfo();
        return $statement;
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
        $this->cleanup();
        return $this->statement->fetch($pdoFetchOption);
    }

    public function fetchAll($pdoFetchOption = PDO::FETCH_OBJ)
    {
        $this->cleanup();
        return $this->statement->fetchAll($pdoFetchOption);
    }

    public function cleanup()
    {
        $this->statement = null;
    }
}