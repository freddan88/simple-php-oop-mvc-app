<?php

declare(strict_types=1);

require_once(__DIR__ . "../../app/database/helpers/Database.php");

class User {
    use Database;

    private $pdoStatement;

    public function debug()
    {
        return $this->sqlite();
    }

    public function add($field, $value, $pdoParam = PDO::PARAM_STR)
    {
        $this->pdoStatement->bind($field, $value, $pdoParam);
        return $this;
    }

    public function save()
    {
        $this->pdoStatement->execute()->cleanup();
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
        $this->pdoStatement = $this->sqlite()->prepare($sql);
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
        $this->pdoStatement = $this->sqlite()->prepare($sql);
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
        $pdoStatement = $this->sqlite()->prepare($sql);
        $pdoStatement->execute()->cleanup();
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
        $pdoStatement = $this->sqlite()->prepare($sql);
        return $pdoStatement->execute()->fetch();
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
        $pdoStatement = $this->sqlite()->prepare($sql);
        return $pdoStatement->execute()->fetchAll();
    }

    // $selectAllSql = $this->table($table)->getAll()->append();
    // $selectAllData = $this->sqlite()->prepare($selectAllSql)->execute()->fetchAll();

    // $selectSql = $this->table($table)->get(['name'])->append('WHERE id = 2');
    // $selectData = $this->sqlite()->prepare($selectSql)->execute()->fetch();


    // public function save()
    // {
    //     $name = 'Fredrik';
    //     $email = $this->sanitizeString($this->postData['email']);
    //     $password = $this->sanitizeString($this->postData['password']);
    //     $admin = 0;

    //     $this->sqlite()->prepare($this->sql)
    //     ->bind($this->fields[0], $name, PDO::PARAM_STR)
    //     ->bind($this->fields[1], $email, PDO::PARAM_STR)
    //     ->bind($this->fields[2], $password, PDO::PARAM_STR)
    //     ->bind($this->fields[3], $admin, PDO::PARAM_INT)
    //     ->execute()->cleanup();
    // }
}