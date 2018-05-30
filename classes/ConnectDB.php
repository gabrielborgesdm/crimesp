<?php
 # Created by Gabriel Borges de Moraes on April 1st, 2018

include 'configDB.php';

class ConnectDB {

    //Atributos
    private $host, $dbname, $user, $password;
    private $insertBuilder, $selectBuilder, $updateBuilder, $deleteBuilder;
    private $fieldName, $builderToExec, $searchBuilder;
    private $sql, $pdo, $row, $query, $error;

    //Métodos especiais
    public function __construct() {
        $db = configDB();
        $this->setHost($db['host']);
        $this->setDbname($db['name']);
        $this->setUser($db['user']);
        $this->setPassword($db['password']);
        $this->connect();
    }

    public function getHost() {
        return $this->host;
    }

    public function getDbname() {
        return $this->dbname;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSql() {
        return $this->sql;
    }

    public function getPdo() {
        return $this->pdo;
    }

    public function getRow() {
        return $this->row;
    }

    public function getQuery() {
        return $this->query;
    }

    public function getError() {
        return $this->error;
    }
    public function getFieldName() {
        return $this->fieldName;
    }
    public function getBuilderToExec() {
        return $this->builderToExec;
    }

    public function getInsertBuilder() {
        return $this->insertBuilder;
    }

    public function getSelectBuilder() {
        return $this->selectBuilder;
    }

    public function getUpdateBuilder() {
        return $this->updateBuilder;
    }
    
    public function getDeleteBuilder() {
        return $this->deleteBuilder;
    }

    public function getSearchBuilder() {
        return $this->searchBuilder;
    }
    
    public function setHost($host) {
        $this->host = $host;
    }

    public function setDbname($dbname) {
        $this->dbname = $dbname;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSql($sql) {
        $this->sql = $sql;
        $this->prepararSql();
    }

    public function setPdo($pdo) {
        $this->pdo = $pdo;
    }

    public function setOperacao($operacao) {
        $this->operacao = $operacao;
    }

    public function setRow($row) {
        $this->row = $row;
    }

    public function setQuery($query) {
        $this->query = $query;
    }

    public function setError($error) {
        $this->error = $error;
    }
    
    public function setFieldName($table) {
        $fieldName = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" .$table ."'";
        $this->fieldName = $fieldName;
        $this->setBuilderToExec("select");
        $this->execBuilder($fieldName);
        
    }
    
    public function setBuilderToExec($builder){
        #It tells to execBuilder() which is the next operation that needs be executed
        
        $this->builderToExec = $builder;
    }

    public function setSelectBuilder($table, $field = null, $condition = null) {
        /*
         * setSelectBuilder(): It mounts a select sql string and then goes to the exec function
         * $field: fields of the table, can be an array with each field name
         * $field: also can be null(in this case it'll select every field of th table)
         * $condition: multidimensional associative array, sintax ([i] - [condName] => [conVal], [operator] => [and/or])
         */
        if (is_null($field)) {
            $selectBuilder = "SELECT * FROM $table";
        }
        else {
            $selectBuilder = "SELECT ";
            if (is_array($field)) {
                $tamanho = count($field);
                $i = 0;
                foreach ($field as $f) {
                    $i++;
                    $selectBuilder .= "$f";

                    if ($i < $tamanho) {
                        $selectBuilder .= ", ";
                    }
                    else {
                        $selectBuilder .= " FROM $table";
                    }
                }
            }
            else {
                $selectBuilder .= "$field FROM $table";
            }
        }

        if (!is_null($condition)) {
            
            for ($i = 0; $i < count($condition); $i++) {
                $selectBuilder .= " WHERE " . $condition[$i]['col'] . " = " . $condition[$i]['value'];
                if(!empty($condition[$i]['operator'])){
                    $selectBuilder .= " " . $condition[$i]['operator']; 
                }
            }
        }
        else {
            $selectBuilder .= " ;";
        }
        $this->selectBuilder = $selectBuilder;
        $this->setBuilderToExec("select");
        $this->execBuilder($selectBuilder);
    }

    public function setInsertBuilder($table, $result) {
         /*
         * setInsertBuilder(): It mounts a insert sql string
         * $result: multidimensional associative array, sintax ([i] - [$field] => [$value])
         */
        $insertBuilder = "INSERT INTO $table(";
        $tamanho = count($result);
        $i = 0;

        foreach ($result as $field => $value) {
            $i++;
            $insertBuilder .= "$field";
            if ($i < $tamanho) {
                $insertBuilder .= ", ";
            }
            else {
                $insertBuilder .= ") ";
            }
        }

        $insertBuilder .= "VALUES(";

        $i = 0;

        foreach ($result as $field => $value) {
            $i++;
            if (is_int($value) or is_double($value)) {
                $insertBuilder .= $value;
            }
            else if (is_array($value)) {
                $array = json_encode($value);
                $insertBuilder .= "'" . $array . "'";
            }
            else {
                $insertBuilder .= '"' . $value . '"';
            }

            if ($i < $tamanho) {
                $insertBuilder .= ", ";
            }
            else {
                $insertBuilder .= ") ";
            }
        }
        $this->insertBuilder = $insertBuilder;
        $this->setBuilderToExec("insert");
        $this->execBuilder($insertBuilder);
    }

    public function setUpdateBuilder($table, $result, $condition) {
         /*
         * setUpdateBuilder(): It mounts a insert sql string
         * $result: multidimensional associative array, sintax ([i] - [$field] => [$value])
         * $condition: associative array
         */
        $updateBuilder = "UPDATE $table SET ";
  
        $i = 0;
        $count = count($result);
        foreach ($result as $field => $value) {
            $i++;
            if (is_int($value) or is_double($value)) {
                $updateBuilder .= "$field = $value";
            }
            else if (is_array($value)) {
                $array = json_encode($value);
                $updateBuilder .= "$field = '" . $array . "'";
            }
            else {
                $updateBuilder .= "$field = '".$value."'";
            }
            if($i < $count){
                 $updateBuilder .= ", ";
            }
        }
        
        $updateBuilder .= " WHERE ";
        foreach ($condition as $field => $value) {
            $updateBuilder .= "$field = '$value[0]' ";
            if(isset($value[1])){
                $updateBuilder .= "$value[1] ";
            }
        }
        $updateBuilder .= " ;";
        $this->updateBuilder = $updateBuilder;
        $this->setBuilderToExec("update");
        $this->execBuilder($updateBuilder);
    }
    
    public function setDeleteBuilder($table, $condition){
        $deleteBuilder = "DELETE FROM $table WHERE " . $condition['col'] . " = " . $condition['value'];
        $this->setBuilderToExec("delete");
        $this->deleteBuilder = $deleteBuilder;
        $this->execBuilder($deleteBuilder);
    }

    public function setSearchBuilder($mode, $table, $field = null, $value = null, $orderBy = null, $order = null) {
        /* 
        * $mode can be 1 for specific cases(and) or 2 for general ones(or)
        * $field reffers to  the table fields, it could be an array or not,
        * $value is the same as $field is, therefore it contains strings to be analyzed
        * $orderby is the name of the 'order by' sql element
        * $order can be 'asc', 'desc' or null if $orderBy doesn't be defined 
        */
        ($mode == 1)?$mode = ' AND ':$mode = ' OR ';
        $searchBuilder = "SELECT * FROM $table";
        if($field != null and $value != null){
            $searchBuilder .= " WHERE ";
            if(is_array($field)){
                for($i = 0; $i < count($field); $i++){
                    if(is_array($value)){
                        foreach($value as $v){
                            $searchBuilder .= " $field[$i] LIKE '%". $v . "' OR $field[$i] LIKE '%".$v."%' OR $field[$i] LIKE '". $v . "%'";
                        }
                    }else{
                        $searchBuilder .= " $field[$i] LIKE '%". $value . "' OR $field[$i] LIKE '%".$value."%' OR $field[$i] LIKE '". $value . "%'";
                    }
                    ($i + 1 == count($field))?: $searchBuilder .= $mode;
                }
            }else{
                if(is_array($value)){
                    foreach($value as $v){
                        $searchBuilder .= " $field LIKE '%". $v . "' OR $field LIKE '%".$v."%' OR $field LIKE '". $v . "%'";
                    }
                }else{
                    $searchBuilder .= " $field LIKE '%". $value . "' OR $field LIKE '%".$value."%' OR $field LIKE '". $value . "%'";
                } 
            }
        }
        if(!empty($orderBy) and !empty($order)){
            $searchBuilder .=" ORDER BY $orderBy $order ";
        }
        $searchBuilder .=' ;'; 

        $this->searchBuilder = $searchBuilder;
       
        $this->setBuilderToExec("select");
        $this->execBuilder($searchBuilder);
    }
    
    //Methods
    public function connect() {
        $host = $this->getHost();
        $dbname = $this->getDbname();
        $user = $this->getUser();
        $password = $this->getPassword();
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setPDO($pdo);
    }
    
    public function execBuilder($builder) {
        /*
         * execBuilder() is called after every builder method get finished
         * $builder is the string created by those methods
         */
        $pdo = $this->getPdo();
        $operation = $this->getBuilderToExec();
       
        
        switch($operation){
            case "update":
            case "select":
                try {
                    $query = $pdo->prepare($builder);
                    $query->execute();
                    $this->setQuery($query);
                } catch (PDOException $e){
                    $this->setError($e->getMessage());
                }   
                break;
            case "insert":
            case "delete":
                try {
                    $stmt = $pdo->prepare($builder);
                    $stmt->execute();  
                  } catch(PDOException $e) {
              
                      $this->setError($e->getMessage());
                  }
                break;
        } 
            
        
    }
}
