<?php
class ConexaoPDO{
    //Atributos
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $sql;
    private $conexao;
    private $query;
    public $linha;
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
    public function getConexao() {
        return $this->conexao;
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
    public function setConexao($conexao) {
        $this->conexao = $conexao;
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
        $conexao = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conexao->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $this->setConexao($conexao);
    }
    public function prepararSql() {
        $conexao = $this->getConexao();
        $query = $conexao->prepare($this->getSql());
        $this->setQuery($query);
    }
    public function bindarSql($parametros){
        $query = $this->getQuery();
        foreach ($parametros as $p=>$b){
            $query->bindParam("$p", $b);
        }
        $this->setQuery($query);
    }
    #Executa a query
    public function executar(){  
        $query = $this->getQuery();
        $linha = $query->execute();
        if ($linha){
            $linha = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->setLinha($linha);
        }
        else{
            $this->setErro(1);
        }
    }
}
