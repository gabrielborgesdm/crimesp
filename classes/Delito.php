<?php
require_once'classes\ConexaoPDO.php';
class Delito{
	//Atributos
	private $nome, $id, $descricao;
	private $sentenca, $tempoCadeia;
	private $resultadoPost, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConexaoPDO();
        $this->setConexao($conexao);
    }
    
    public function getNome(){
		return $this->nome;	
	}
    public function getId(){
		return $this->id;	
	}
	public function getSentenca(){
		return $this->sentenca;	
	}
	public function getTempoCadeia(){
		return $this->tempoCadeia;	
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
    public function setNome($nome){
		$this->nome = $nome;
	}
    public function setId($id){
		$this->id = $id;
	}
	public function setSentenca($sentenca){
		$this->sentenca = $sentenca;
	}
	public function setTempoCadeia($tempoCadeia){
	
        $this->tempoCadeia = json_encode($tempoCadeia);   
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
        $this->setSentenca($resultado["sentenca"]);
        if(!empty($resultado["tempoCadeia"])){
            $this->setTempoCadeia($resultado["tempoCadeia"]);       
        }
    }
    
    public function cadastrarDelitos(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("delito", $this->getResultadoPost());
    	echo "<pre>";
    	#print_r($conexao->getInsertBuilder());
    	#die();
    	$conexao->execInsert();
    	if($conexao->getErro()){
    		
    		echo $conexao->getErro();
    	}
    	else{
    		include('formSucesso.php');
    	}
    }
}