<?php
require_once 'ConexaoPDO.php';
class Delito{
	//Atributos
	private $nome;
	private $id;
	private $descricao;
	private $sentenca;
	private $tempoCadeia;
	private $resultadoPost;

    //Métodos Especiais
    public function __construct($resultado) {
  		$this->setResultadoPost($resultado);
        $this->setNome($resultado["nome"]);
        $this->setDescricao($resultado["descricao"]);
        $this->setSentenca($resultado["sentenca"]);
        if(!empty($resultado["tempoCadeia"])){
        	$this->setTempoCadeia($resultado["tempoCadeia"]);     	
        }
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
    //Métodos
    public function cadastrarDelitos($conexao){
    	$conexao->setInsertBuilder("delito", $this->getResultadoPost());
    	echo "<pre>";
    	#print_r($conexao->getInsertBuilder());
    	#die();
    	$conexao->execInsert();
    	if($conexao->getErro()){
    		
    		echo $conexao->getErro();
    	}
    	else{
    		echo "foi";
    	}
    }
}