<?php

declare(strict_types=1);

Trait Database {
    
    private $databaseConnection;

    public function sqlite($databaseName = 'sqlite')
    {
        $databasePath = sprintf('sqlite:%s/database_%s.db', __DIR__, $databaseName);
        $this->databaseConnection = new PDO($databasePath);
        return $this;
    }
}