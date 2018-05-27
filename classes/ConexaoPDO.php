<?php

include 'configDB.php';

class ConexaoPDO {

    //Atributos
    private $host, $dbname, $user, $password;
    private $insertBuilder, $selectBuilder, $updateBuilder, $deleteBuilder;
    private $builderToExec, $likeBuilder;
    private $sql, $pdo, $linha, $query, $erro;

    //Métodos especiais
    public function __construct() {
        $db = configDB();
        $this->setHost($db['host']);
        $this->setDbname($db['name']);
        $this->setUser($db['user']);
        $this->setPassword($db['password']);
        $this->conectarBanco();
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

    public function getLinha() {
        return $this->linha;
    }

    public function getQuery() {
        return $this->query;
    }

    public function getErro() {
        return $this->erro;
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

    public function getLikeBuilder() {
        return $this->likeBuilder;
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

    public function setLinha($linha) {
        $this->linha = $linha;
    }

    public function setQuery($query) {
        $this->query = $query;
    }

    public function setErro($erro) {
        $this->erro = $erro;
    }
    
    //Essa função dita qual será a proxima operação a ser executada
    public function setBuilderToExec($builder){
        $this->builderToExec = $builder;
    }

    public function setSelectBuilder($tabela, $tupla = null, $condition = null) {

        if (is_null($tupla)) {
            $selectBuilder = "SELECT * FROM $tabela";
        }
        else {
            $selectBuilder = "SELECT ";
            if (is_array($tupla)) {
                $tamanho = count($tupla);
                $i = 0;
                foreach ($tupla as $col) {
                    $i++;
                    $selectBuilder .= "$col";

                    if ($i < $tamanho) {
                        $selectBuilder .= ", ";
                    }
                    else {
                        $selectBuilder .= " FROM $tabela";
                    }
                }
            }
            else {
                $selectBuilder .= "$tupla FROM $tabela";
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

    public function setInsertBuilder($tabela, $resultado) {
        $insertBuilder = "INSERT INTO $tabela(";
        $tamanho = count($resultado);
        $i = 0;

        foreach ($resultado as $col => $value) {
            $i++;
            $insertBuilder .= "$col";
            if ($i < $tamanho) {
                $insertBuilder .= ", ";
            }
            else {
                $insertBuilder .= ") ";
            }
        }

        $insertBuilder .= "VALUES(";

        $i = 0;

        foreach ($resultado as $col => $value) {
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

    public function setUpdateBuilder($tabela, $resultado, $condition) {
        $updateBuilder = "UPDATE $tabela SET ";
  
        $i = 0;
        $count = count($resultado);
        foreach ($resultado as $col => $value) {
            $i++;
            if (is_int($value) or is_double($value)) {
                $updateBuilder .= "$col = $value";
            }
            else if (is_array($value)) {
                $array = json_encode($value);
                $updateBuilder .= "$col = '" . $array . "'";
            }
            else {
                $updateBuilder .= "$col = '".$value."'";
            }
            if($i < $count){
                 $updateBuilder .= ", ";
            }
        }
        
        $updateBuilder .= " WHERE ";
        foreach ($condition as $col => $value) {
            $updateBuilder .= "$col = '$value[0]' ";
            if(isset($value[1])){
                $updateBuilder .= "$value[1] ";
            }
        }
        $updateBuilder .= " ;";
        $this->updateBuilder = $updateBuilder;
        $this->setBuilderToExec("update");
        $this->execBuilder($updateBuilder);
    }
    
    public function setDeleteBuilder($tabela, $condition){
        $deleteBuilder = "DELETE FROM $tabela WHERE " . $condition['col'] . " = " . $condition['value'];
        $this->setBuilderToExec("delete");
        $this->deleteBuilder = $deleteBuilder;
        $this->execBuilder($deleteBuilder);
    }
    
    public function execBuilder($builder) {
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
                    $this->setErro($e->getMessage());
                }   
                break;
            case "insert":
            case "delete":
                try {
                    $stmt = $pdo->prepare($builder);
                    $stmt->execute();  
                  } catch(PDOException $e) {
              
                      $this->setErro($e->getMessage());
                  }
                break;
        } 
            
        
    }
    
    public function setLikeBuilder($tabela, $col, $filter) {
       
        $setLikeBuilder = "SELECT * FROM $tabela WHERE $col LIKE %$filter OR"
                . "$col LIKE %$filter% OR $col LIKE $filter%";
       
        $this->setLikeBuilder = $setLikeBuilder;
        $this->setBuilderToExec("select");
        $this->execBuilder($setLikeBuilder);
    }
    
    //Métodos
    #Recupera valores e atribui $conexao ao mesmo atributo da classe.
    public function conectarBanco() {
        $host = $this->getHost();
        $dbname = $this->getDbname();
        $user = $this->getUser();
        $password = $this->getPassword();
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setPDO($pdo);
    }

}
