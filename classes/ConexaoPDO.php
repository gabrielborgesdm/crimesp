<?php

class ConexaoPDO {

    //Atributos
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $insertBuilder;
    private $selectBuilder;
    private $sql;
    private $pdo;
    private $query;
    private $linha;
    private $erro;

    //Métodos especiais
    public function __construct($host, $dbName, $user, $password) {
        $this->setHost($host);
        $this->setDbname($dbName);
        $this->setUser($user);
        $this->setPassword($password);
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

    public function getQuery() {
        return $this->query;
    }

    public function getLinha() {
        return $this->linha;
    }

    public function getErro() {
        return $this->erro;
    }
    public function getInsertBuilder() {
        return $this->insertBuilder;
    }
    public function getSelectBuilder() {
        return $this->insertBuilder;
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

    public function setQuery($query) {
        $this->query = $query;
    }

    public function setOperacao($operacao) {
        $this->operacao = $operacao;
    }

    public function setLinha($linha) {
        $this->linha = $linha;
    }

    public function setErro($erro) {
        $this->erro = $erro;
    }

    //Métodos
    #Recupera valores e atribui $conexao ao mesmo atributo da classe.
    public function conectarBanco() {
        $host = $this->getHost();
        $dbname = $this->getDbname();
        $user = $this->getUser();
        $password = $this->getPassword();
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setPDO($pdo);
    }

    public function setInsertBuilder($tabela, $resultado) {
        $insertBuilder = "INSERT INTO $tabela(";
        $tamanho = count($resultado);
        $i = 0;

        foreach ($resultado as $key => $value) {
            $i++;
            $insertBuilder .= "$key";
            if ($i < $tamanho) {
                $insertBuilder .= ", ";
            }
            else {
                $insertBuilder .= ") ";
            }
        }

        $insertBuilder .= "VALUES(";
        $tamanho = count($resultado);
        $i = 0;

        foreach ($resultado as $key => $value) {
            $i++;
            if (is_int($value) or is_double($value)) {
                $insertBuilder .= "$value";
            }
            else if (is_array($value)) {
                $array = json_encode($value);
                $insertBuilder .= "'" . $array . "'";
            }
            else {
                $insertBuilder .= "'$value'";
            }

            if ($i < $tamanho) {
                $insertBuilder .= ", ";
            }
            else {
                $insertBuilder .= ") ";
            }
        }
        $this->insertBuilder = $insertBuilder;
    }

    public function setSelectBuilder($tabela, $resultado, $where) {
        $selectBuilder = "SELECT ";
        $tamanho = count($resultado);
        $i = 0;

        foreach ($resultado as $key => $value) {
            $i++;
            $selectBuilder .= "$key";
            if ($i < $tamanho) {
                $selectBuilder .= ", ";
            }
            else {
                $selectBuilder .= " FROM ";
            }
        }

        $selectBuilder .= "$tabela ";
        if($where != 0){
            $selectBuilder .= "WHERE $where['key'] = $where['value']";
        }

        
        $this->$selectBuilder = $selectBuilderr;
    }
    #Executa a query

    public function execInsert() {
        try {
            $pdo = $this->getPdo();
            $pdo->exec($this->getInsertBuilder());
        } catch (PDOException $e) {
            $this->setErro($e);
        }
    }

}
