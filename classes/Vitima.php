<?php
require_once 'ConexaoPDO.php';
class Vitima{
	//Atributos
	private $nome;
    private $id;
	private $endereco;
	private $dataNasc;
    private $sexo;
	private $cpf;
	private $resultadoPost;

    //Métodos Especiais
    public function __construct($resultado) {
  		$this->setResultadoPost($resultado);
        $this->setNome($resultado["nome"]);
        $this->setDataNasc($resultado["dataNasc"]);
        $this->setSexo($resultado["sexo"]);
        
        if(!empty($resultado["endereco"])){
        	$this->setEndereco($resultado["endereco"]);
    	}

        if(!empty($resultado["cpf"])){
        	$this->setCpf($resultado["cpf"]);
        }			
        
    }

    public function getNome(){
		return $this->nome;	
	}
    public function getId(){
		return $this->id;	
	}
	public function getEndereco(){
		return $this->endereco;	
	}
	public function getDataNasc(){
		return $this->dataNasc;	
	}
    public function getSexo(){
		return $this->sexo;	
	}
	public function getCpf(){
		return $this->cpf;	
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
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	public function setDataNasc($dataNasc){
		$this->dataNasc = $dataNasc;
	}
    public function setSexo($sexo){
        $this->sexo = $sexo;
    }
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}
    public function setResultadoPost($resultadoPost){
    	$this->resultadoPost = $resultadoPost;
    }
    //Métodos
    public function cadastrarVitima($conexao){
    	$conexao->setInsertBuilder("vitima", $this->getResultadoPost());
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