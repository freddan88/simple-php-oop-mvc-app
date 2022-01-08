<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/Database.php");
require_once(__DIR__ . "../../app/security/Sanitize.php");

class User extends Sanitize {
    use Database;

    public function __construct()
    {
        $table = 'tbl_users';
        $fields = ['name', 'email', 'password', 'role'];
        // $insertSql = $this->table($table)->insert($fields)->append();
        // $this->sqlite()->prepare($insertSql)
        // ->bind($fields[0],'Roger', PDO::PARAM_STR)
        // ->bind($fields[1],'roger@test.se', PDO::PARAM_STR)
        // ->bind($fields[2],'123', PDO::PARAM_STR)
        // ->bind($fields[3], 2, PDO::PARAM_INT)
        // ->execute();

        // $updateSql = $this->table($table)->update(['name'])->append('WHERE id = 1');
        // $this->sqlite()->prepare($updateSql)
        // ->bind($fields[0],'Freddan', PDO::PARAM_STR)
        // ->execute();

        // $selectAllSql = $this->table($table)->getAll()->append();
        // $selectAllData = $this->sqlite()->prepare($selectAllSql)->execute()->fetchAll();

        // $selectSql = $this->table($table)->get(['name'])->append('WHERE id = 2');
        // $selectData = $this->sqlite()->prepare($selectSql)->execute()->fetch();

        $deleteSql = $this->table($table)->delete()->append('WHERE id = 2');
        $this->sqlite()->prepare($deleteSql)->execute()->cleanup();

        // $this->sqlite()->insert()->table('tbl_users')->fields($fields)->debugSql();
        // $value = $this->sqlite()->get($fields)->table('tbl_users')->prepare()->execute()->fetchAll();
        // $value = $this->sqlite()->getAll()->table('tbl_users')->prepare()->execute()->fetch();
        // $this->sqlite()->prepare()
        // ->bind($fields[0], 'Fredrik Leemann', PDO::PARAM_STR)
        // ->bind($fields[1], 'fredrik@leemann.se', PDO::PARAM_STR)
        // ->bind($fields[2], '123', PDO::PARAM_STR)
        // ->bind($fields[3], '123', PDO::PARAM_INT)
        // ->execute(); 
        // $value = empty($value->name) ? '' : $this->sanitizeString($value->name);
        // die(var_dump($value));
    }
}