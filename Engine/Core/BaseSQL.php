<?php

require_once('Config.php');

use Engine\Core\Config;

class BaseSQL{

    private $config;
    private $connection;
    public $database;
    public $errors = [];
    public $queryes = [];
    public $result = [];
    public $autoCommit = false;

    public function __construct(String $database){
        $this->config = new Config();
        $this->database = $database;
        $this->connection = new mysqli($this->config->get('DB_HOST'), $this->config->get('DB_USER'), $this->config->get('DB_PASS'), $database);
        if ($this->connection->connect_error) {
            $this->errors[]['Error'] = $this->connection->connect_error;
            $this->errors[]['Query'] = "Connection to database $database";
        }
        $this->connection->autocommit($this->autoCommit);
    }

    public function setDatabase(String $database){
        $this->database = $database;
    }

    /*
    *   @param $query String
    */
    public function query(String $query){
        $this->queryes[] = $query;
    }

    /*
    *  @param $index int
    */
    public function getQuery(int $index){
        return $this->queryes[$index];
    }

    public function getQueryes(){
        return $this->queryes;
    }

    public function quitQuery(int $index){
        
        if (isset($this->queryes[$index])){
            unset($this->queryes[$index]);
        }

    }

    public function SetAutoCommit(bool $value){
        $this->autoCommit = $value;
        $this->connection->autocommit($this->autoCommit);
    }

    public function getResult(){
        return $this->result;
    }

    public function getRow(int $index){

        if (isset($this->result[$index])) {
            return $this->result[$index]['Result']->fetch_assoc();
        }

    }


    public function getInsertId(){
        return $this->connection->insert_id;
    }

    /*
    *   @param $table String
    *   @param $data Array
    *   @param $where String
    */

    public function update(String $table, Array $data, array $condition){
        $query = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $query .= "$key = '$value', ";
        }
        $query = substr($query, 0, -2);

        $Condition = $this->toCondition($condition);

        $this->query($query.$Condition);
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

    public function delete(String $table, array $condition){
        $query = "DELETE FROM $table".$this->toCondition($condition);
        $this->query($query);
    }

    /*
    *   @param $table String
    *   @param $where String
    */

    public function select(String $table, String $condition, String $order = null){

        $query = "SELECT * FROM $table $condition";
        if ($order != null) {
            $query .= " ORDER BY $order";
        }

        // Execute query
        $this->query($query);

        // Commit query
        $this->Apply();

        // Return result assoc
        return $this->result;
        
    }

    /*
    *   @param $table String
    *   @param $condition String
    */

    public function showTable(String $table){

        $this->clearResult();

        $query = "SHOW TABLES LIKE '$table'"; 

        $this->query($query);

        // Return result assoc
        return $this->Apply();
    }

    public function showColumns(String $table, Array $condition = null){

        $this->clearResult();

        $query = "SHOW COLUMNS FROM $table";

        if ($condition != null) {
            $condition = $this->toCondition($condition);
        }

        $this->query($query.$condition);

        // Commit query
        

        // Return result assoc
        return $this->Apply();
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

    public function selectOne(String $table, String $condition){
        $query = "SELECT * FROM $table $condition";
        $this->query($query);
    }

    /*
    *   Alter table
    *   @param $table String
    *   @param $data Array
    */

    public function alterTable(String $table, String $AlterType, String $Column, String $Type = null, int $Length = null, Array $Data, bool $PK = null, Array $FK = null){

        $query = "ALTER TABLE $table ";

        $query .= "$AlterType $Column";

        if ($Type != null) {
            $query .= " $Type";

            if ($Length != null) {
                $query .= "($Length)";
            }

        }

        foreach ($Data as $key => $value) {
            $query .= " $key $value";
        }

        if ($PK != null) {
            $query .= " PRIMARY KEY ";
        }

        if ($FK != null) {
            $query .= " FOREIGN KEY (";
            foreach ($FK as $key => $value) {
                $query .= "$key, ";
            }
            $query = substr($query, 0, -2);
            $query .= ") REFERENCES $FK[0]($FK[1])";
        }

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
    public function selectCount(String $table, array $condition){

        $Condition = $this->toCondition($condition);

        $query = "SELECT COUNT(*) FROM $table".$Condition;
        $this->query($query);
    }

    /*
    *   @return $errors count
    */
    
    public function countErrors(){
        return count($this->errors);
    }

    /*
    *   @return $errors
    */

    public function getErrors(){
        return $this->errors;
    }

    /*
    *   @return $conditions
    */
    
    private function toCondition(Array $conditions = []){
        
        // Ej
        // $conditions = [
        //     '=' => [
        //         'id_article' => [$ArticleCart->get('id_article'),'']
        //     ]
        // ];
        $query = '';
        
        if (count($conditions) > 0) {
            $query = ' WHERE ';

            foreach($conditions as $condicional_key => $condicional_value){

                foreach($condicional_value as $key => $value){
    
                    if($condicional_key != "IN" AND $condicional_key != "NOT IN"){
                        $value[0] = "'".$value[0]."'";
                    }
    
                    $query .= "`".$key."` ".$condicional_key." {$value[0]} ".$value[1]." ";
                }
            }

        }

        return $query;
 
    }

    /*
    *   @return $this
    */
    public function clearResult(){
        $this->result = [];
        return $this;
    }

    /*
    *   @return $this
    */

    public function clearQueryes(){
        $this->queryes = [];
        return $this;
    }

    /*
    *  Close connection
    */

    public function close(){
        $this->connection->close();
    }

    /*
    *   @return bool
    */

    public function Apply(){

        $num_errors = 0;

        foreach ($this->queryes as $query) {
            echo $query.'<br>';
            mysqli_query($this->connection, $query);
            $this->result[] = [];

            $countResultIndex = count($this->result) - 1;

            $this->result[$countResultIndex]['Query'] = $query;
            $this->result[$countResultIndex]['Error'] = '';
            $this->result[$countResultIndex]['Result'] = '';
            $this->result[$countResultIndex]['NumRows'] = 0;
            $this->result[$countResultIndex]['Rows'] = [];

            if (!$result = mysqli_query($this->connection, $query)) {
                $this->result[$countResultIndex]['Error'] = $this->connection->error;
                $num_errors++;
            }else if ($result && $this->connection->affected_rows > 0) {
                $this->result[$countResultIndex]['Result'] = $result;
                // Num rows
                $this->config->pre_array($result);
                $this->result[$countResultIndex]['NumRows'] = $result->num_rows;
                
                // Rows
                while ($row = $result->fetch_assoc()) {
                    $this->result[$countResultIndex]['Rows'][] = $row;
                }
            }

        }

        if ($num_errors > 0) {
            $this->connection->rollback();
            return false;
        }else{
            $this->connection->commit();
        }
        
        $results = $this->result;

        $this->clearResult();
        $this->clearQueryes();

        return $results;

    }

}

?>