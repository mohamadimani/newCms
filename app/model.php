<?php

namespace App;

use App\Db;
use Error;
use PDO;
use PDOException;

class Model
{
    private static $db;
    protected $_table;
    protected $_isEdit = false;
    protected $_fields = [];
    protected $delete_key = 'id';

    function __construct()
    {
        $this->_init_db();
    }

    private   function _init_db()
    {
        try {
            self::$db = new PDO("mysql:host=" . Env::getDbEnv('host') . ";dbname=" . Env::getDbEnv('dbname'), Env::getDbEnv('username'), Env::getDbEnv('password'));
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
        if ($this->_fields['id'] > 0) {
            $id = $this->_fields['id'];
            unset($this->_fields['id']);
            $fieldsKey = implode('=? ,', array_keys($this->_fields)) . '=?';
            $query = "UPDATE {$this->_table} SET $fieldsKey WHERE `$this->delete_key` = ? ";
            $this->_fields['id'] = $id;
        } else {
            $fieldsKey = implode(',', array_keys($this->_fields));
            $values = setQuestionMarkForQuery($this->_fields);
            $query = "INSERT INTO {$this->_table}  ($fieldsKey) VALUES ($values) ";
        }
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
        $prepare->bindValue(1, $this->_fields[$this->delete_key]);
        if ($prepare->execute()) {
            return true;
        }
        return false;
    }

    public function findBy($param = '', $field = '')
    {
        $query = "SELECT * FROM {$this->_table} WHERE `$field` = ? ";
        $prepare = $this->db()->prepare($query);
        $prepare->bindValue(1, $param);
        $prepare->execute();
        if ($field == 'id') {
            $result = (object) $prepare->fetch(2);
        } else {
            $result = (object)$prepare->fetchAll();
        }
        return $result;
    }
    public function __set($name, $value)
    {
        if (in_array($name, array_keys($this->_fields))) {
            $this->_fields[$name] = $value;
        } else {
            vd('Field not exist', 0, 1);
        }
    }

    public function __call($name, $arguments)
    {
        $name = strtolower($name);
        if (substr($name, 0, strlen('findby')) ==  'findby') {
            $functionName = str_replace('findby', '', $name);
            if (in_array($functionName, array_keys($this->_fields))) {
                $arguments['field'] = $functionName;
                return  call_user_func_array([$this,  'findBy'], $arguments);
            } else {
                vd('field not found', 0, 1);
            }
        } else {
            vd('function not found', 0, 1);
        }
    }
}
