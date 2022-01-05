<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/utils/Database.php");

class USER extends Database {

    public function __construct()
    {
        var_dump($this->getHandler());
    }
}