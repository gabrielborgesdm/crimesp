<?php
require_once'classes\ConexaoPDO.php';
class Criminoso{
	//Atributos
	private $nome, $id, $endereco, $dataNasc, $sexo, $cpf;
	private $sentenca, $tempoCadeia, $dataExec; 
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
	public function getSentenca(){
		return $this->sentenca;	
	}
	public function getTempoCadeia(){
		return $this->tempoCadeia;	
	}
    public function getDataExec(){
        return $this->dataExec;
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
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	public function setDataNasc($dataNasc){
		$this->dataNasc = $dataNasc;
	}
    public function setSexo($sexo){
        $this->sexo = $sexo;
    }
	public function setSentenca($sentenca){
		$this->sentenca = $sentenca;
	}
	public function setTempoCadeia($tempoCadeia){
	
        $this->tempoCadeia = json_encode($tempoCadeia);   
	}
	public function setCpf($cpf){
		$this->setCpf = $cpf;
	}
    public function setDataExec($dataExec){
        $this->dataExec = $dataExec;
    }
    public function setResultadoPost($resultadoPost){
    	$this->resultadoPost = $resultadoPost;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
    //Métodos
    public function recebeDados($resultado) {
       
        $this->setResultadoPost($resultado);
        $this->setNome($resultado["nome"]);
        $this->setDataNasc($resultado["dataNasc"]);
        $this->setSexo($resultado["sexo"]);
        $this->setSentenca($resultado["sentenca"]);
        
        if(!empty($resultado["dataExec"])){
            $this->setDataExec($resultado["dataExec"]);
        }

        if(!empty($resultado["tempoCadeia"])){
            $this->setTempoCadeia($resultado["tempoCadeia"]);       
        }

        if(!empty($resultado["endereco"])){
            $this->setEndereco($resultado["endereco"]);
        }

        if(!empty($resultado["cpf"])){
            $this->setCpf($resultado["cpf"]);
        }           
        
    }
    
    public function cadastrarCriminoso(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("criminoso", $this->getResultadoPost());
    	if($conexao->getErro()){
    		//include('formErro.php');
    	}
    	else{
    		include('formSucesso.php');
    	}
    }
    public function listarCriminoso($campos = null, $condition = null){
        $conexao = $this->getConexao();
    
        $tabela = "infocriminoso"; 
        
        if(is_null($campos)){
            $campos = null;
        }
        
        if(is_null($condition)){
            $condition = null; 
        }
        
        $conexao->setSelectBuilder($tabela, $campos, $condition);  
        
    	if(!$conexao->getErro()){
            return $conexao->getQuery();
    	}
    }
    
    public function apagarCriminoso($condition){
        $conexao = $this->getConexao();
        $conexao->setDeleteBuilder("criminoso", $condition);
    }
    
    public function alterarCriminoso($condition){
        $conexao = $this->getConexao();
        $tupla = $this->getResultadoPost();
        $conexao->setUpdateBuilder("criminoso", $tupla , $condition);
    }
    
}