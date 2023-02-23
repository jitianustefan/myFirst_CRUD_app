<?php

class Database {
    private $_host='localhost';
    private $_username='root';
    private $_password='00000000';
    private $_database='stiri';

    private $connection;
    private static $instance=null;

    public function __construct(){
        $this->connection= mysqli_connect($this->_host,$this->_username,$this->_password,$this->_database);
        if(mysqli_connect_error()){
            die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errorno());
        }
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }
    public function sanitize($var){
        $return = mysqli_real_escape_string($this->connection,$var);
        return $return; 
    }
}

?>