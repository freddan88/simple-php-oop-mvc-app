<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/Database.php");

class User {
    use Database;

    private $pdoStatement;

    public function add($field, $value, $pdoParam = PDO::PARAM_STR)
    {
        $this->bind($field, $value, $pdoParam);
        return $this;
    }

    public function save()
    {
        $this->execute()->cleanup();
    }
    /**
     * Example usage:
     * $user = new User();
     * $user->create($sql)
     * ->add('fieldName', 'fieldValue', PDO::PARAM_STR)
     * ->save();
     *
     * @param string $sql
     * @return this
     */
    public function create($sql)
    {
        $this->sqlite()->prepare($sql);
        return $this;
    }
    /**
     * Example usage:
     * $user = new User();
     * $user->update($sql)
     * ->add('fieldName', 'fieldValue', PDO::PARAM_STR)
     * ->save();
     *
     * @param string $sql
     * @return this
     */
    public function update($sql)
    {
        $this->sqlite()->prepare($sql);
        return $this;
    }
    /**
     * Example usage:
     * $user = new User();
     * $user->delete($sql);
     *
     * @param string $sql
     * @return void
     */
    public function delete($sql)
    {
        $this->sqlite()->prepare($sql)->execute()->cleanup();
    }
    /**
     * Example usage:
     * $user = new User();
     * $data = $user->get($sql);
     *
     * @param string $sql
     * @return tableData
     */
    public function get($sql)
    {
        return $this->sqlite()->prepare($sql)->execute()->fetch();
    }
    /**
     * Example usage:
     * $user = new User();
     * $data = $user->getAll($sql);
     *
     * @param string $sql
     * @return tableData
     */
    public function getAll($sql)
    {
        return $this->sqlite()->prepare($sql)->execute()->fetchAll();
    }
}