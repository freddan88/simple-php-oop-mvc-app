<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/Database.php");

class User {
    use Database;

    public function __construct()
    {
        $this->sqlite();
    }
}