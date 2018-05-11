<?php
require_once'classes\ConexaoPDO.php';
class Crime{
	//Atributos
	private $descricao, $id, $local, $dataCrime, $criminoso, $vitima; 
	private $resultadoPost, $conexao;

    //Métodos Especiais
    public function __construct($resultado) {
        $db = configDB();
        $conexao = new ConexaoPDO();
        $this->setDescricao($resultado["descricao"]);
        $this->setLocal($resultado["local"]);
        $this->setDataCrime($resultado["dataCrime"]);
		$this->setCriminoso($resultado["criminoso"]);
        $this->setVitima($resultado["vitima"]);
        $this->setConexao($conexao);
        $this->setResultadoPost($resultado);
        
    }

    public function getDescricao(){
		return $this->descricao;	
	}
    public function getId(){
		return $this->id;	
	}
	public function getLocal(){
		return $this->local;	
	}
	public function getDataCrime(){
		return $this->dataCrime;	
	}
    public function getCriminoso(){
		return $this->criminoso;	
	}
	public function getVitima(){
		return $this->vitima;	
	}
    public function getResultadoPost(){
    	return $this->resultadoPost;
    }
    public function getConexao(){
        return $this->conexao;
    }
    public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
    public function setId($id){
		$this->id = $id;
	}
	public function setLocal($local){
		$this->local = $local;
	}
	public function setDataCrime($dataCrime){
		$this->dataCrime = $dataCrime;
	}
    public function setCriminoso($criminoso){
        $this->criminoso = $criminoso;
    }
	public function setVitima($vitima){
		$this->vitima = $vitima;
	}
    public function setResultadoPost($resultadoPost){
    	$this->resultadoPost = $resultadoPost;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
	
    //Métodos
    public function cadastrarCrime(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("crime", $this->getResultadoPost());
    	$conexao->execInsert();
    	if($conexao->getErro()){
    		
    		echo $conexao->getErro();
    	}
    	else{
    		echo "foi";
    	}
    }
}