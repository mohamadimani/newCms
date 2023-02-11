<?php

namespace App;

use App\Db;
use Error;
use PDO;
use PDOException;

class Model
{
    private static $db;
    private $host;
    private $dbName;
    private $userName;
    private $password;
    protected $_table;
    protected $_fields = [];
    protected $delete_key = 'id';

    function __construct()
    {
        $this->_init_db();
    }

    private   function _init_db()
    {
        try {
            $this->host = Env::getDbEnv('host');
            $this->dbName = Env::getDbEnv('dbname');
            $this->userName = Env::getDbEnv('username');
            $this->password = Env::getDbEnv('password');
            self::$db = new PDO("mysql:host=$this->host;dbname=$this->dbName", $this->userName, $this->password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            vd($error->getMessage(), 0, 1);
        }
    }

    public static function DB()
    {
        return self::$db;
    }

    public function save()
    {
        $fieldsKey = implode(',', array_keys($this->_fields));
        $values = setQuestionMarkForQuery($this->_fields);
        $query = "INSERT INTO {$this->_table} ($fieldsKey) VALUES ($values)";
        $prepare = $this->db()->prepare($query);
        $culomnNumber = 1;
        foreach ($this->_fields as $key => $value) {
            $prepare->bindValue($culomnNumber, $value);
            $culomnNumber++;
        }
        if ($prepare->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM   {$this->_table} WHERE `$this->delete_key` = ?";
        $prepare = $this->db()->prepare($query);
        $prepare->bindValue(1, $this->_table[$this->delete_key]);
        if ($prepare->execute()) {
            return true;
        }
        return false;
    }

    public function __set($name, $value)
    {
        if (in_array($name, array_keys($this->_fields))) {
            $this->_fields[$name] = $value;
        } else {
            vd('Field not exist', 0, 1);
        }
    }
}
