<?php
require_once'classes\ConnectDB.php';
class Criminoso{
	//Atributos
	private $nome, $id, $endereco, $dataNasc, $sexo, $cpf;
	private $sentenca, $tempoCadeia, $dataExec; 
	private $fields, $conexao;

    //Métodos Especiais
    public function __construct(){
        $conexao = new ConnectDB();
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
    public function getFields(){
    	return $this->fields;
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
    public function setFields($resultado) {
        $fields = Array();
        
        $this->setNome($resultado["nome"]);
        $fields['nome'] = $resultado["nome"];
        
        $this->setDataNasc($resultado["dataNasc"]);
        $fields['data_nasc'] = $resultado["dataNasc"];
        
        $this->setSexo($resultado["sexo"]);
        $fields['sexo'] = $resultado["sexo"];
        
        $this->setSentenca($resultado["sentenca"]);
        $fields['id_sentenca'] = $resultado["sentenca"];
        
        if(!empty($resultado["dataExec"])){
            $this->setDataExec($resultado["dataExec"]);
            $fields['data_exec'] = $resultado["dataExec"];
        }

        if(!empty($resultado["tempoCadeia"])){
            $this->setTempoCadeia($resultado["tempoCadeia"]);
            $fields['tempo_cadeia'] = $resultado["tempoCadeia"];
        }

        if(!empty($resultado["endereco"])){
            $this->setEndereco($resultado["endereco"]);
            $fields['endereco'] = $resultado["endereco"];
        }

        if(!empty($resultado["cpf"])){
            $this->setCpf($resultado["cpf"]);
            $fields['cpf'] = $resultado["cpf"];
        }           
        
        $this->fields = $fields;
    }
    public function setConexao($conexao){
        $this->conexao = $conexao;
    }
    //Métodos
    public function cadastrarCriminoso(){
        $conexao = $this->getConexao();
    	$conexao->setInsertBuilder("criminoso", $this->getFields());
    	if(!$conexao->getError()){
    		return $conexao->getQuery();
    	}
    }
    public function listarCriminoso($campos = null, $condition = null){
        $conexao = $this->getConexao();
        $tabela = "view_criminoso"; 
        $conexao->setSelectBuilder($tabela, $campos, $condition);  
    	if(!$conexao->getError()){
            return $conexao->getQuery();
    	}
    }
    
    public function apagarCriminoso($condition){
        $conexao = $this->getConexao();
        $conexao->setDeleteBuilder("criminoso", $condition);
        $this->setConexao($conexao);
    }
    
    public function alterarCriminoso($condition){
        $conexao = $this->getConexao();
        $fields = $this->getFields();
        $conexao->setUpdateBuilder("criminoso", $fields , $condition);
    }
    
    public function filtrarCriminoso($col, $filter){
        $conexao = $this->getConexao();
        $tabela = "infocriminoso"; 
        $conexao->setSelectBuilder($tabela, $col, $filter);  
    	if(!$conexao->getErro()){
            return $conexao->getQuery();
    	}
    }
    
}