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
    	$conexao->execInsert();
    	if($conexao->getErro()){
    		
    		echo $conexao->getErro();
    	}
    	else{
    		include('formSucesso.php');
    	}
    }
    public function listarDelito($campos = null, $where = null){
        $conexao = $this->getConexao();
        $result = Array();
        $result[0] = "delito"; 
        
        if(!is_null($campos)){
            $result[1] = $campos; 
        }else{
            $result[1] = null;
        }
        
        if(!is_null($where)){
            $result[2] = $where; 
        }else{
            $result[2] = null;
        }
        
        $conexao->setSelectBuilder($result);      
    	$conexao->execSelect();
        
    	if($conexao->getErro()){
    		return 1;                    #ARRUMAR ISSO EM TODAS AS CLASSES
    	}
    	else{
    		return $conexao->getQuery();
    	}
    }
}