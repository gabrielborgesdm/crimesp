<?php
require_once'classes\ConexaoPDO.php';
class Crime{
	//Atributos
	private $descricao, $id, $local, $dataCrime, $criminoso, $vitima, $delito; 
	private $resultadoPost, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConexaoPDO();
        $this->setConexao($conexao);
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
    public function getDelito(){
		return $this->delito;	
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
    public function setDelito($delito){
		$this->delito = $delito;
	}
    public function setResultadoPost($resultadoPost){
    	$this->resultadoPost = $resultadoPost;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
	
    //Métodos
     public function recebeDados($resultado) {
        $conexao = $this->getConexao();
        $this->setDescricao($resultado["descricao"]);
        $this->setLocal($resultado["local"]);
        $this->setDataCrime($resultado["dataCrime"]);
		$this->setCriminoso($resultado["criminoso"]);
        $this->setVitima($resultado["vitima"]);
        $this->setConexao($conexao);
        $this->setResultadoPost($resultado);
    }
    
    public function cadastrarCrime(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("crime", $this->getResultadoPost());
    	if($conexao->getErro()){
    		echo $conexao->getErro();
    	}
    	else{
    		include('formSucesso.php');
    	}
    }
    public function listarCrime($campos = null, $where = null){
        $conexao = $this->getConexao();
        $tabela = "infocrime"; 
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
    
    public function apagarCrime($condition){
        $conexao = $this->getConexao();
        $conexao->setDeleteBuilder("crime", $condition);
    }
    
    public function alterarCrime($condition){
        $conexao = $this->getConexao();
        $tupla = $this->getResultadoPost();
        $conexao->setUpdateBuilder("crime", $tupla , $condition);
    }
    
    
}