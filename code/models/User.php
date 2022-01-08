<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/Database.php");

class User {
    use Database;

    public function __construct()
    {
        $fields = ['name', 'email', 'password', 'role'];
        $value = $this->sqlite()->getAll()->table('tbl_users')->prepare()->execute()->fetch();
        // $this->sqlite()->prepare()
        // ->bind($fields[0], 'Fredrik Leemann', PDO::PARAM_STR)
        // ->bind($fields[1], 'fredrik@leemann.se', PDO::PARAM_STR)
        // ->bind($fields[2], '123', PDO::PARAM_STR)
        // ->bind($fields[3], '123', PDO::PARAM_INT)
        // ->execute();
        die(var_dump($value->name));
    }
}