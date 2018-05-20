<?php
require_once'classes\ConexaoPDO.php';
class Delito{
	//Atributos
	private $nome, $id, $descricao;
	private $resultadoPost, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConexaoPDO();
        $this->setConexao($conexao);
    }
    public function getId(){
		return $this->id;	
	}
    public function getNome(){
		return $this->nome;	
	}
    public function getDescricao() {
        return $this->descricao;
    }
    public function getResultadoPost(){
    	return $this->resultadoPost;
    }
    public function getConexao(){
        return $this->conexao;
    }
    public function setId($id){
		$this->id = $id;
	}
    public function setNome($nome){
		$this->nome = $nome;
	}
    public function setResultadoPost($resultadoPost){
    	$this->resultadoPost = $resultadoPost;
    }
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
    //Métodos
    public function recebeDados($resultado) {
        $db = configDB();
        $conexao = new ConexaoPDO();
        $this->setConexao($conexao);
        $this->setResultadoPost($resultado);
        $this->setNome($resultado["nome"]);
        $this->setDescricao($resultado["descricao"]);
    }
    
    public function cadastrarDelitos(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("delito", $this->getResultadoPost());
    	if($conexao->getErro()){
    		echo $conexao->getErro();
    	}
    	else{
    		include('formSucesso.php');
    	}
    }
    public function listarDelito($campos = null, $where = null){
        $conexao = $this->getConexao();
        $tabela = "delito"; 
        if(is_null($campos)){
            $campos = null;
        }
        if(is_null($where)){
            $where = null; 
        }
        $conexao->setSelectBuilder($tabela, $campos, $where);      
        
        if(!$conexao->getErro()){
            return $conexao->getQuery();
        }
    }
}