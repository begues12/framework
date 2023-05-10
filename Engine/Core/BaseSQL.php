<?php
namespace Engine\Core;

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
    public $showErrors = true;

    public function __construct(String $database){
        $this->config = new Config();
        $this->database = $database;
        // $this->connection = new mysqli($this->config->get('DB_HOST'), $this->config->get('DB_USER'), $this->config->get('DB_PASS'), $database);
        $this->connection = new \mysqli($this->config->get('DB_HOST'), $this->config->get('DB_USER'), $this->config->get('DB_PASS'), $database);
        if ($this->connection->connect_error) {
            $this->errors[]['Error'] = $this->connection->connect_error;
            $this->errors[]['Query'] = "Connection to database $database";
        }
        $this->connection->autocommit($this->autoCommit);

        if (!$this->showErrors){
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', 'Off');
        }

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

    /* Delete <table></table>
    *   @param $table String

    */

    public function dropTable(String $table){
        $query = "DROP TABLE $table";
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
    *   @param $where String
    */

    public function getTables(){
        
        $this->clearResult();

        $query = "SHOW TABLES"; 

        $this->query($query);

        // Return result assoc
        return $this->Apply();
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
    *   @param $AlterType String
    *   @param $Column String
    *   @param $Type String
    *   @param $Length int
    *   @param $Data Array
    *   @param $PK bool
    *   @param $FK Array
    */

    public function alterTable(
        string $table,
        string $alterType,
        string $column,
        ?string $type = null,
        ?string $length = null,
        ?bool $ai = null,
        ?string $default = null,
        ?bool $pk = null,
        ?bool $unique = null,
        ?bool $null = null,
        ?array $fk = null
    ): string {
        $columnsInfo = $this->showColumns($table)[0]['Rows'];

        foreach ($columnsInfo as $columnInfo) {
            if ($columnInfo['Key'] === 'PRI' && $pk == true) {
                $this->query("ALTER TABLE $table DROP PRIMARY KEY");
                echo "ALTER TABLE $table DROP PRIMARY KEY";
                break;
            }
        }
        
        $query = "ALTER TABLE $table $alterType $column";
        
        if ($type !== null) {
            $query .= " $type";
            
            if ($length !== null) {
                $query .= "($length)";
            }
        }
        
        if ($pk !== null && $pk) {
            $query .= " PRIMARY KEY";
        }
        
        if ($ai === null && $ai) {
            $query .= " AUTO_INCREMENT";
        }
        
        if ($null !== null) {
            $query .= $null ? " NULL" : " NOT NULL";
        }
        
        if ($null !== true && $default !== null && $default !== '') {
            $query .= " DEFAULT '$default'";
        }
        
        if ($null !== true && $unique !== null && $unique) {
            $query .= " UNIQUE";
        }
        
        if ($fk !== null) {
            $query .= " FOREIGN KEY (";
            $query .= implode(', ', array_keys($fk));
            $query .= ") REFERENCES $fk[0]($fk[1])";
        }
        
        $query .= ";";
        
        $this->query($query);
        
        return $query;
    }
    public function OK(){

        if (count($this->errors) == 0) {
            return true;
        }else{
            return false;
        }

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

    public function getFields(String $table){
        $query = "SHOW COLUMNS FROM $table";
        $this->query($query);

        return $this->Apply();

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
                // $this->config->pre_array($result);
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
        
        // $this->close();

        $results = $this->result;

        $this->clearResult();
        $this->clearQueryes();

        return $results;

    }

}

####################
#        ,~~~.     #
#       (\___/)    #
#       /_O_O_\    #
#      {=^___^=}   #
#       \_/ \_/    #
#__________________#
# Github:@Begues12 #
####################

?>