<?php

require_once('Config.php');

use Engine\Core\Config;

class BaseSQL{

    private $config;
    private $connection;
    public $database;
    public $error;
    public $result;

    public function __construct(String $database){
        $this->config = new Config();
        $this->database = $database;
        $this->connection = new mysqli($this->config->get('DB_HOST'), $this->config->get('DB_USER'), $this->config->get('DB_PASS'), $database);
        if ($this->connection->connect_error) {
            $this->error = $this->connection->connect_error;
        }
    }

    public function setDatabase(String $database){
        $this->database = $database;
    }

    public function query(String $query){
        $this->result = $this->connection->query($query);
        if ($this->connection->error) {
            $this->error = $this->connection->error;
        }
    }

    public function getError(){
        return $this->error;
    }

    public function getResult(){
        return $this->result;
    }

    public function getRow(){
        return $this->result->fetch_assoc();
    }

    public function getRows(){
        $rows = [];
        while ($row = $this->result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getNumRows(){
        return $this->result->num_rows;
    }

    public function getInsertId(){
        return $this->connection->insert_id;
    }

    /*
    *   @param $table String
    *   @param $data Array
    *   @param $where String
    */

    public function update(String $table, Array $data, String $where){
        $query = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $query .= "$key = '$value', ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE $where";
        $this->query($query);
    }

    /*
    *   @param $table String
    *   @param $data Array
    */

    public function insert(String $table, Array $data){
        $query = "INSERT INTO $table (";
        foreach ($data as $key => $value) {
            $query .= "$key, ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($data as $key => $value) {
            $query .= "'$value', ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
        $this->query($query);
    }

    /*
    *   @param $table String
    *   @param $where String
    */

    public function delete(String $table, String $where){
        $query = "DELETE FROM $table WHERE $where";
        $this->query($query);
    }

    /*
    *   @param $table String
    *   @param $where String
    */

    public function select(String $table, String $where){
        $query = "SELECT * FROM $table WHERE $where";
        $this->query($query);
    }

    /*
    *   @param $table String
    */

    public function selectAll(String $table){
        $query = "SELECT * FROM $table";
        $this->query($query);
    }

    /*
    *   @param $table String
    *   @param $where String
    */

    public function selectOne(String $table, String $where){
        $query = "SELECT * FROM $table WHERE $where";
        $this->query($query);
    }

    /*
    *   Alter table
    *   @param $table String
    *   @param $data Array
    */

    public function alterTable(String $table, Array $data){
        $query = "ALTER TABLE $table ";
        foreach ($data as $key => $value) {
            $query .= "$key $value, ";
        }
        $query = substr($query, 0, -2);
        $this->query($query);
    }

    /* Create table
    *   @param $table String
    */

    public function createTable(String $table, Array $data){
        $query = "CREATE TABLE $table (";
        foreach ($data as $key => $value) {
            $query .= "$key $value, ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
        $this->query($query);
    }

    /*
    *   @param $table String
    *   @param $where String
    */
    public function selectCount(String $table, String $where){
        $query = "SELECT COUNT(*) FROM $table WHERE $where";
        $this->query($query);
    }

    /*
    *  Close connection
    */

    public function close(){
        $this->connection->close();
    }



}

?>