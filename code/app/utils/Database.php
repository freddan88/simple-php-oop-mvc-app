<?php

declare(strict_types=1);

class Database {

    public function getHandler()
    {
        $databasePath = sprintf('sqlite:%s/../database/sqlite.db', __DIR__);
        return new PDO($databasePath);
    }
}