<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh = null;
    private $stmt = null;
    private $error = null;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4';
        
        $options = array(
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            error_log('Database Connection Error: ' . $this->error);
            $this->dbh = null;
        }
    }

    public function isConnected() {
        return $this->dbh !== null;
    }

    public function query($sql) {
        if (!$this->dbh) {
            $this->stmt = null;
            return false;
        }
        try {
            $this->stmt = $this->dbh->prepare($sql);
            return true;
        } catch (PDOException $e) {
            error_log('Query Prepare Error: ' . $e->getMessage() . ' in SQL: ' . $sql);
            $this->stmt = null;
            return false;
        }
    }

    public function bind($param, $value, $type = null) {
        if (!$this->stmt) return;
        
        if (is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        if (!$this->stmt) return false;
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            error_log('Query Execute Error: ' . $e->getMessage());
            return false;
        }
    }

    public function resultSet() {
        if (!$this->stmt) return [];
        try {
            $this->execute();
            $res = $this->stmt->fetchAll();
            return is_array($res) ? $res : [];
        } catch (PDOException $e) {
            error_log('Query Fetch Error: ' . $e->getMessage());
            return [];
        }
    }

    public function single() {
        if (!$this->stmt) return null;
        try {
            $this->execute();
            $res = $this->stmt->fetch();
            return $res ?: null;
        } catch (PDOException $e) {
            error_log('Query Fetch Single Error: ' . $e->getMessage());
            return null;
        }
    }

    public function rowCount() {
        return $this->stmt ? $this->stmt->rowCount() : 0;
    }
    
    public function lastInsertId() {
        return $this->dbh ? $this->dbh->lastInsertId() : 0;
    }
}
