<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/Database.php");
require_once(__DIR__ . "../../app/security/Sanitize.php");

class User extends Sanitize {
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
        $name = empty($value->name) ? '' : $this->sanitizeString($value->name);
        die(var_dump($name));
    }
}